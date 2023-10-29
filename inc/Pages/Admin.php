<?php
/*
* @package MuuPlugin
*/

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;

class Admin extends BaseController
{

    public $settings;
    public $pages;
    public $sub_pages;

    public function __construct()
    {
        $this->settings = new SettingsApi();
        $this->pages = [
            [
                'page_title' => 'Muu Plugin',
                'menu_title' => 'Muu',
                'capability' => 'manage_options',
                'menu_slug'  => 'muu_plugin',
                'callback'   => function () {
                    echo "<h1>Muu plugin</h1>";
                },
                'icon_url'   => 'dashicons-store',
                'position'   => 110
            ]
        ];
        $this->sub_pages = [
            [
                'parent_slug' => 'muu_plugin',
                'page_title'  => 'Custom post type',
                'menu_title'  => 'CPT',
                'capability'  => 'manage_options',
                'menu_slug'   => 'muu_cpt',
                'callback'    => function () {
                    echo "<h1>CPT Manager</h1>";
                }
            ],
            [
                'parent_slug' => 'muu_plugin',
                'page_title'  => 'Custom taxonomies',
                'menu_title'  => 'Taxonomies',
                'capability'  => 'manage_options',
                'menu_slug'   => 'muu_taxonomies',
                'callback'    => function () {
                    echo "<h1>Taxonomies Manager</h1>";
                }
            ],
            [
                'parent_slug' => 'muu_plugin',
                'page_title'  => 'Custom widgets',
                'menu_title'  => 'Widgets',
                'capability'  => 'manage_options',
                'menu_slug'   => 'muu_widgets',
                'callback'    => function () {
                    echo "<h1>Widgets Manager</h1>";
                }
            ],
        ];
    }

    public function register()
    {
        $this->settings->addPages($this->pages)
            ->withSubPage('Dashboard')
            ->addSubPage($this->sub_pages)
            ->register();
    }


    // public function add_admin_pages()
    // {
    //     add_menu_page('Muu Plugin', 'Muu', 'manage_options', 'muu_plugin', [$this, 'admin_index'], 'dashicons-store', 110);
    // }

    // function admin_index()
    // {
    //     require_once "{$this->plugin_path}templates/admin.php";
    // }
}
