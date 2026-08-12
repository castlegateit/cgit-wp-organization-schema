<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema;

class OptionsPage
{
    /**
     * Menu slug
     *
     * @var string
     */
    public const SLUG = 'cgit_wp_organization_schema';

    /**
     * Initialization
     *
     * @return void
     */
    public static function init(): void
    {
        $page = new static();

        add_action('acf/init', [$page, 'register']);

        OptionsPageFields::init();
    }

    /**
     * Return page title
     *
     * @return string
     */
    public static function title(): string
    {
        return __('Organization Schema');
    }

    /**
     * Register options page
     *
     * @return void
     */
    public function register(): void
    {
        $args = apply_filters('cgit_wp_organization_schema_options_page_args', [
            'page_title' => static::title(),
            'menu_slug' => static::SLUG,
            'menu_icon' => [
                'type' => 'dashicons',
            ],
            'icon_url' => 'dashicons-info-outline',
            'capability' => 'edit_others_pages',
            'autoload' => true,
            'redirect' => false,
        ]);

        $args['menu_slug'] = static::SLUG;

        acf_add_options_page($args);
    }
}
