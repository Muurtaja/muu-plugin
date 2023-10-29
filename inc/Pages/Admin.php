<?php
/*
* @package MuuPlugin
*/

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{

    public $settings;
    public $pages;
    public $sub_pages;
    public $callbacks;

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->setPages();
        $this->setSubPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings
            ->addPages($this->pages)
            ->withSubPage('Dashboard')
            ->addSubPage($this->sub_pages)
            ->register();
    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => 'Muu Plugin',
                'menu_title' => 'Muu',
                'capability' => 'manage_options',
                'menu_slug'  => 'muu_plugin',
                'callback'   => [$this->callbacks, 'adminDashboard'],
                'icon_url'   => 'dashicons-store',
                'position'   => 110
            ]
        ];
    }

    public function setSubPages()
    {

        $this->sub_pages = [
            [
                'parent_slug' => 'muu_plugin',
                'page_title'  => 'Custom post type',
                'menu_title'  => 'CPT',
                'capability'  => 'manage_options',
                'menu_slug'   => 'muu_cpt',
                'callback'   => [$this->callbacks, 'adminCpt'],
            ],
            [
                'parent_slug' => 'muu_plugin',
                'page_title'  => 'Custom taxonomies',
                'menu_title'  => 'Taxonomies',
                'capability'  => 'manage_options',
                'menu_slug'   => 'muu_taxonomies',
                'callback'   => [$this->callbacks, 'adminTaxonomy'],
            ],
            [
                'parent_slug' => 'muu_plugin',
                'page_title'  => 'Custom widgets',
                'menu_title'  => 'Widgets',
                'capability'  => 'manage_options',
                'menu_slug'   => 'muu_widgets',
                'callback'   => [$this->callbacks, 'adminWidget'],
            ],
        ];
    }
    public function setSettings()
    {

        $args = [
            [
                'option_group' => 'muu_options_group',
                'option_name'  => 'text_example',
                'callback'  => [$this->callbacks, 'muuOptionsGroup'],
            ],
            [
                'option_group' => 'muu_options_group',
                'option_name'  => 'first_name',
            ]
        ];

        $this->settings->setSettings($args);
    }

    public function setSections()
    {
        $args = [
            [
                'id'       => 'muu_section_index',
                'title'    => 'Settings',
                'callback' => [$this->callbacks, 'muuSectionGroup'],
                'page'     => 'muu_plugin',

            ]
        ];
        $this->settings->setSections($args);
    }
    public function setFields()
    {
        $args = [
            [
                'id'       => 'text_example',
                'title'    => 'Text example',
                'callback' => [$this->callbacks, 'muuTextExample'],
                'page'     => 'muu_plugin',
                'section'  => 'muu_section_index',
                'args'     => [
                    'label_for' => 'text_example',
                    'class' => 'example-class',
                ],
            ],
            [
                'id'       => 'first_name',
                'title'    => 'First Name',
                'callback' => [$this->callbacks, 'muuFirstName'],
                'page'     => 'muu_plugin',
                'section'  => 'muu_section_index',
                'args'     => [
                    'label_for' => 'first_name',
                    'class' => 'first-name',
                ],
            ]
        ];
        $this->settings->setFields($args);
    }
}
