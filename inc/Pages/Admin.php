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
            ],
            [
                'page_title' => 'Test Plugin',
                'menu_title' => 'Test',
                'capability' => 'manage_options',
                'menu_slug'  => 'test_plugin',
                'callback'   => function () {
                    echo "<h1>Test plugin</h1>";
                },
                'icon_url'   => 'dashicons-external',
                'position'   => 110
            ]
        ];
    }

    public function register()
    {

        $this->settings->addPages($this->pages)->register();
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
