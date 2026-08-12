<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema;

use Castlegate\OrganizationSchema\Schema\Organization;
use Castlegate\SchemaMap\Registry;

class Plugin
{
    /**
     * Initialization
     *
     * @return void
     */
    public static function init(): void
    {
        OptionsPage::init();

        $plugin = new static();

        add_action('init', [$plugin, 'register']);

        // Remove organization schema from Yoast schema output
        add_filter('wpseo_schema_graph_pieces', [$plugin, 'removeYoastOrganizationSchema'], 11, 2);
    }

    /**
     * Register organization schema with Schema Map
     *
     * @return void
     */
    public function register(): void
    {
        if (!class_exists(Registry::class)) {
            return;
        }

        Registry::register([$this, 'schema']);
    }

    /**
     * Populate and return schema object
     *
     * @return Organization
     */
    public function schema(): Organization
    {
        if (!function_exists('get_field')) {
            return new Organization();
        }

        // Organization schema instance
        $namespace = '\\Castlegate\\OrganizationSchema\\Schema\\';
        $type = get_field('cgit_wp_organization_schema_type', 'options');
        $class = $namespace . $type;

        if (!class_exists($class)) {
            $class = $namespace . 'Organization';
        }

        $organization = new $class();

        // Non-editable information
        $organization->url(home_url('/'));

        // Information from options page
        $name = get_field('cgit_wp_organization_schema_name', 'options');
        $description = get_field('cgit_wp_organization_schema_description', 'options');
        $email = get_field('cgit_wp_organization_schema_email', 'options');
        $telephone = get_field('cgit_wp_organization_schema_telephone', 'options');
        $fax_number = get_field('cgit_wp_organization_schema_fax_number', 'options');

        if ($name) {
            $organization->name($name);
        }

        if ($description) {
            $organization->description($description);
        }

        if ($email) {
            $organization->email($email);
        }

        if ($telephone) {
            $organization->telephone($telephone);
        }

        if ($fax_number) {
            $organization->faxNumber($fax_number);
        }

        // Images from options page
        $logo_url = get_field('cgit_wp_organization_schema_logo_url', 'options');
        $image_url = get_field('cgit_wp_organization_schema_image_url', 'options');

        if ($logo_url) {
            $organization->logo($logo_url);
        }

        if ($image_url) {
            $organization->image($image_url);
        }

        // Links from options page
        $links = get_field('cgit_wp_organization_schema_same_as_links', 'options');

        if (is_array($links)) {
            $urls = array_column($links, 'url');

            if ($urls) {
                $organization->sameAs($urls);
            }
        }

        // Address from options page
        $organization->address([
            'streetAddress' => get_field('cgit_wp_organization_schema_street_address', 'options'),
            'extendedAddress' => get_field('cgit_wp_organization_schema_extended_address', 'options'),
            'addressLocality' => get_field('cgit_wp_organization_schema_address_locality', 'options'),
            'addressRegion' => get_field('cgit_wp_organization_schema_address_region', 'options'),
            'postalCode' => get_field('cgit_wp_organization_schema_postal_code', 'options'),
            'postOfficeBoxNumber' => get_field('cgit_wp_organization_schema_post_office_box_number', 'options'),
            'addressCountry' => get_field('cgit_wp_organization_schema_address_country', 'options'),
        ]);

        // Location from options page
        $location = get_field('cgit_wp_organization_schema_geo_location', 'options');

        $organization->geo([
            'address' => $location['address'] ?? '',
            'addressCountry' => $location['country_short'] ?? '',
            'latitude' => $location['lat'] ?? '',
            'longitude' => $location['lng'] ?? '',
            'postalCode' => $location['post_code'] ?? '',
        ]);

        // Opening hours from options page
        $hours = get_field('cgit_wp_organization_schema_opening_hours', 'options');

        if (is_array($hours)) {
            $organization->openingHours($hours);
        }

        return $organization;
    }

    /**
     * Remove organization schema from Yoast schema output
     *
     * @param array $pieces
     * @param object $context
     * @return array
     */
    public function removeYoastOrganizationSchema(array $pieces, object $context): array
    {
        return array_filter($pieces, function ($piece) {
            return !$piece instanceof \Yoast\WP\SEO\Generators\Schema\Organization;
        });
    }
}
