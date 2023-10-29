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
                'callback'   => [$this->callbacks, 'cptManager'],
            ],
            [
                'parent_slug' => 'muu_plugin',
                'page_title'  => 'Custom taxonomies',
                'menu_title'  => 'Taxonomies',
                'capability'  => 'manage_options',
                'menu_slug'   => 'muu_taxonomies',
                'callback'   => [$this->callbacks, 'taxonomiesManager'],
            ],
            [
                'parent_slug' => 'muu_plugin',
                'page_title'  => 'Custom widgets',
                'menu_title'  => 'Widgets',
                'capability'  => 'manage_options',
                'menu_slug'   => 'muu_widgets',
                'callback'   => [$this->callbacks, 'widgetsManager'],
            ],
        ];
    }
}
