<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema;

class OptionsPageFields
{
    /**
     * Initialization
     *
     * @return void
     */
    public static function init(): void
    {
        $fields = new static();

        add_action('acf/init', [$fields, 'register'], 20);
    }

    /**
     * Register fields
     *
     * @return void
     */
    public function register(): void
    {
        $location = [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => OptionsPage::SLUG,
                ],
            ],
        ];

        acf_add_local_field_group([
            'title' => __('Organization details'),
            'key' => 'cgit_wp_organization_schema_organization_details_fields',
            'location' => $location,
            'menu_order' => 10,
            'label_placement' => 'left',
            'fields' => [
                [
                    'label' => 'Organization type',
                    'key' => 'cgit_wp_organization_schema_type',
                    'name' => 'cgit_wp_organization_schema_type',
                    'type' => 'select',
                    'multiple' => false,
                    'allow_null' => false,
                    'ui' => true,
                    'choices' => static::getSchemaTypeChoices(),
                ],

                [
                    'label' => 'Organization name',
                    'key' => 'cgit_wp_organization_schema_name',
                    'name' => 'cgit_wp_organization_schema_name',
                    'type' => 'text',
                ],

                [
                    'label' => 'Description',
                    'key' => 'cgit_wp_organization_schema_description',
                    'name' => 'cgit_wp_organization_schema_description',
                    'type' => 'textarea',
                    'rows' => 4,
                ],
            ],
        ]);

        acf_add_local_field_group([
            'title' => __('Contact details'),
            'key' => 'cgit_wp_organization_schema_contact_details_fields',
            'location' => $location,
            'menu_order' => 20,
            'label_placement' => 'left',
            'fields' => [
                [
                    'label' => 'Email address',
                    'key' => 'cgit_wp_organization_schema_email',
                    'name' => 'cgit_wp_organization_schema_email',
                    'type' => 'email',
                ],

                [
                    'label' => 'Telephone number',
                    'key' => 'cgit_wp_organization_schema_telephone',
                    'name' => 'cgit_wp_organization_schema_telephone',
                    'type' => 'text',
                ],

                [
                    'label' => 'Fax number',
                    'key' => 'cgit_wp_organization_schema_fax_number',
                    'name' => 'cgit_wp_organization_schema_fax_number',
                    'type' => 'text',
                ],
            ],
        ]);

        acf_add_local_field_group([
            'title' => __('Address'),
            'key' => 'cgit_wp_organization_schema_address_fields',
            'location' => $location,
            'menu_order' => 30,
            'label_placement' => 'left',
            'fields' => [
                [
                    'label' => 'Street address',
                    'key' => 'cgit_wp_organization_schema_street_address',
                    'name' => 'cgit_wp_organization_schema_street_address',
                    'type' => 'text',
                ],

                [
                    'label' => 'Extended address',
                    'key' => 'cgit_wp_organization_schema_extended_address',
                    'name' => 'cgit_wp_organization_schema_extended_address',
                    'type' => 'text',
                ],

                [
                    'label' => 'Locality',
                    'key' => 'cgit_wp_organization_schema_address_locality',
                    'name' => 'cgit_wp_organization_schema_address_locality',
                    'type' => 'text',
                ],

                [
                    'label' => 'Region',
                    'key' => 'cgit_wp_organization_schema_address_region',
                    'name' => 'cgit_wp_organization_schema_address_region',
                    'type' => 'text',
                ],

                [
                    'label' => 'Postcode',
                    'key' => 'cgit_wp_organization_schema_postal_code',
                    'name' => 'cgit_wp_organization_schema_postal_code',
                    'type' => 'text',
                ],

                [
                    'label' => 'Post office box number',
                    'key' => 'cgit_wp_organization_schema_post_office_box_number',
                    'name' => 'cgit_wp_organization_schema_post_office_box_number',
                    'type' => 'text',
                ],

                [
                    'label' => 'Country',
                    'key' => 'cgit_wp_organization_schema_address_country',
                    'name' => 'cgit_wp_organization_schema_address_country',
                    'type' => 'select',
                    'multiple' => false,
                    'allow_null' => true,
                    'ui' => true,
                    'choices' => static::getCountryChoices(),
                ],
            ],
        ]);

        acf_add_local_field_group([
            'title' => __('Location'),
            'key' => 'cgit_wp_organization_schema_location_fields',
            'location' => $location,
            'menu_order' => 40,
            'label_placement' => 'left',
            'fields' => [
                [
                    'label' => 'Location',
                    'key' => 'cgit_wp_organization_schema_geo_location',
                    'name' => 'cgit_wp_organization_schema_geo_location',
                    'type' => 'google_map',
                    'center_lat' => 53.957011,
                    'center_lng' => -1.080756,
                ],
            ],
        ]);

        acf_add_local_field_group([
            'title' => __('Images'),
            'key' => 'cgit_wp_organization_schema_images_fields',
            'location' => $location,
            'menu_order' => 50,
            'label_placement' => 'left',
            'fields' => [
                [
                    'label' => 'Logo',
                    'key' => 'cgit_wp_organization_schema_logo_url',
                    'name' => 'cgit_wp_organization_schema_logo_url',
                    'type' => 'image',
                    'preview_size' => 'medium',
                    'return_format' => 'url',
                ],

                [
                    'label' => 'Image',
                    'key' => 'cgit_wp_organization_schema_image_url',
                    'name' => 'cgit_wp_organization_schema_image_url',
                    'type' => 'image',
                    'preview_size' => 'medium',
                    'return_format' => 'url',
                ],
            ],
        ]);

        acf_add_local_field_group([
            'title' => __('External links'),
            'key' => 'cgit_wp_organization_schema_external_links_fields',
            'location' => $location,
            'menu_order' => 60,
            'label_placement' => 'left',
            'fields' => [
                [
                    'label' => 'Links',
                    'key' => 'cgit_wp_organization_schema_same_as_links',
                    'name' => 'cgit_wp_organization_schema_same_as_links',
                    'type' => 'repeater',
                    'instructions' => 'Links that represent the organization on other sites, e.g. social networks.',
                    'button_label' => 'Add Link',
                    'sub_fields' => [
                        [
                            'label' => 'Link URL',
                            'key' => 'cgit_wp_organization_schema_same_as_links__url',
                            'name' => 'url',
                            'type' => 'url',
                            'required' => true,
                        ],
                    ],
                ],
            ],
        ]);

        acf_add_local_field_group([
            'title' => __('Opening hours'),
            'key' => 'cgit_wp_organization_schema_opening_hours_fields',
            'location' => $location,
            'menu_order' => 70,
            'label_placement' => 'left',
            'fields' => [
                [
                    'label' => 'Opening hours',
                    'key' => 'cgit_wp_organization_schema_opening_hours',
                    'name' => 'cgit_wp_organization_schema_opening_hours',
                    'type' => 'repeater',
                    'button_label' => 'Add Opening Hours',
                    'sub_fields' => [
                        [
                            'label' => 'Days',
                            'key' => 'cgit_wp_organization_schema_opening_hours_items__days',
                            'name' => 'days',
                            'type' => 'select',
                            'required' => true,
                            'multiple' => true,
                            'ui' => true,
                            'choices' => [
                                'Mo' => 'Monday',
                                'Tu' => 'Tuesday',
                                'We' => 'Wednesday',
                                'Th' => 'Thursday',
                                'Fr' => 'Friday',
                                'Sa' => 'Saturday',
                                'Su' => 'Sunday',
                            ],
                            'wrapper' => [
                                'width' => 50,
                            ],
                        ],

                        [
                            'label' => 'Open',
                            'key' => 'cgit_wp_organization_schema_opening_hours_items__opening_time',
                            'name' => 'opening_time',
                            'type' => 'time_picker',
                            'required' => true,
                            'return_format' => 'H:i',
                            'wrapper' => [
                                'width' => 25,
                            ],
                        ],

                        [
                            'label' => 'Closed',
                            'key' => 'cgit_wp_organization_schema_opening_hours_items__closing_time',
                            'name' => 'closing_time',
                            'type' => 'time_picker',
                            'required' => true,
                            'return_format' => 'H:i',
                            'wrapper' => [
                                'width' => 25,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Return available schema types as an ACF choices array
     *
     * @return array
     */
    private static function getSchemaTypeChoices(): array
    {
        $files = scandir(CGIT_WP_ORGANIZATION_SCHEMA_PLUGIN_DIR . '/classes/Schema');
        $files = array_diff($files, ['.', '..']);

        $choices = [];

        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $class = '\\Castlegate\\OrganizationSchema\\Schema\\' . $name;

            if (!class_exists($class)) {
                continue;
            }

            $choices[$name] = $class::LABEL;
        }

        asort($choices);

        return $choices;
    }

    /**
     * Return a list of countries as an ACF choices array
     *
     * Based on <https://github.com/annexare/Countries>.
     *
     * @return array
     */
    private static function getCountryChoices(): array
    {
        $file = CGIT_WP_ORGANIZATION_SCHEMA_PLUGIN_DIR . '/data/countries.json';

        if (!is_file($file)) {
            return [];
        }

        $data = file_get_contents($file);

        if (!is_string($data)) {
            return [];
        }

        $choices = json_decode($data, associative: true);

        if (!is_array($choices)) {
            return [];
        }

        $choices = array_merge(['GB' => ''], $choices);

        return $choices;
    }
}
