<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

use Castlegate\SchemaMap\Schema\Organization\Organization as CastlegateSchemaMapOrganization;
use Castlegate\SchemaMap\Vendor\Spatie\SchemaOrg\Schema;

class Organization extends CastlegateSchemaMapOrganization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization';

    /**
     * Address properties
     *
     * @var array
     */
    private array $address = [];

    /**
     * Location properties
     *
     * @var array
     */
    private array $geo = [];

    /**
     * Opening hours
     *
     * @var array
     */
    private array $openingHours = [];

    /**
     * Set address properties
     *
     * @param array $args
     * @return void
     */
    public function address(array $args): void
    {
        $defaults = [
            'streetAddress' => '',
            'extendedAddress' => '',
            'addressLocality' => '',
            'addressRegion' => '',
            'postalCode' => '',
            'postOfficeBoxNumber' => '',
            'addressCountry' => '',
        ];

        $args = array_filter($args, 'is_string');
        $args = array_map('trim', $args);
        $args = array_filter($args);
        $args = array_intersect_key($args, $defaults);

        $this->address = array_merge($defaults, $args);
    }

    /**
     * Set location properties
     *
     * @param array $args
     * @return void
     */
    public function geo(array $args): void
    {
        $defaults = [
            'address' => '',
            'addressCountry' => '',
            'latitude' => '',
            'longitude' => '',
            'postalCode' => '',
        ];

        $args = array_intersect_key($args, $defaults);
        $args = array_merge($defaults, $args);

        foreach (['address', 'addressCountry', 'postalCode'] as $key) {
            if (!is_string($args[$key])) {
                $args[$key] = '';
            }
        }

        foreach (['latitude', 'longitude'] as $key) {
            $args[$key] = is_numeric($args[$key]) ? (float) $args[$key] : '';
        }

        $this->geo = $args;
    }

    /**
     * Set opening hours
     *
     * See <https://schema.org/openingHours>.
     *
     * @param array $args
     * @return void
     */
    public function openingHours(array $args): void
    {
        $this->openingHours = [];

        foreach ($args as $item) {
            $days = $item['days'] ?? [];
            $opening_time = $item['opening_time'] ?? '';
            $closing_time = $item['closing_time'] ?? '';

            if (
                !is_array($days) ||
                !is_string($opening_time) ||
                !is_string($closing_time) ||
                !$opening_time ||
                !$closing_time
            ) {
                continue;
            }

            $days = array_filter($days, 'is_string');
            $days = array_map('trim', $days);
            $days = array_filter($days);

            if (!$days) {
                continue;
            }

            $this->openingHours[] = implode(',', $days) . ' ' . $opening_time . '-' . $closing_time;
        }
    }

    /**
     * Return spatie/schema-org object
     *
     * @return mixed
     */
    public function toSpatieObject(): mixed
    {
        $class = '\\Castlegate\\SchemaMap\\Vendor\\Spatie\\SchemaOrg\\' . end(explode('\\', static::class));
        $organization = $this->populateSpatieOrganization(new $class());

        // Address property = PostalAddress schema
        if (array_filter($this->address)) {
            $address = Schema::postalAddress();

            foreach ($this->address as $method => $value) {
                $address->$method($value);
            }

            $organization->address($address);
        }

        // Geo property = GeoCoordinates schema
        if (is_float($this->geo['latitude']) && is_float($this->geo['longitude'])) {
            $location = Schema::geoCoordinates();

            foreach ($this->geo as $method => $value) {
                $location->$method($value);
            }

            $organization->geo($location);
        }

        // Opening hours
        if ($this->openingHours) {
            $organization->openingHours($this->openingHours);
        }

        return $organization;
    }
}
