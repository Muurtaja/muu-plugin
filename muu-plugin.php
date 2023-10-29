<?php
/*
* @package MuuPlugin
*/
/*
Plugin Name: Muu Plugin
Plugin URI: https://test.com/
Description: This is my first attempt on writing custom plugin for learning wordpress.
Version: 0.0.1
Requires at least: 5.8
Requires PHP: 5.6.20
Author: Murtaja
Author URI: https://murtaja.com
License: GPLv2 or later
Text Domain: muuplugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2023 Automattic, Inc.
*/

defined('ABSPATH') || die('Hey, you cannot access this file!');
function_exists('add_action') || die('Hey, you cannot access this file!');

class MuuPlugin
{
    public $plugin;
    public function __construct()
    {
        add_action('init', [$this, 'customPostType']);
        $this->plugin = plugin_basename(__FILE__);
    }

    function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
        add_action('admin_menu', [$this, 'add_admin_pages']);

        add_filter('plugin_action_links_' . $this->plugin, [$this, 'settings_link']);
    }

    public function settings_link($links = [])
    {

        if (!is_array($links)) $links = [];
        $links[] = '<a href="admin.php?page=muu_plugin">Settings</a>';

        return $links;
    }

    public function add_admin_pages()
    {
        add_menu_page('Muu Plugin', 'Muu', 'manage_options', 'muu_plugin', [$this, 'admin_index'], 'dashicons-store', 110);
    }
    function admin_index()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
    }
    function activate()
    {
        // generate a CPT
        $this->customPostType();
        // flush rewrite rules
        flush_rewrite_rules();
    }
    function deactivate()
    {
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function customPostType()
    {
        register_post_type('books', ['public' => true, 'label' => 'Books']);
    }

    function enqueue()
    {
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/css/my-style.css', __FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/assets/js/my-script.js', __FILE__));
    }
}

if (class_exists('MuuPlugin')) {
    $muuPlugin = new MuuPlugin();
    $muuPlugin->register();
}


require_once plugin_dir_path(__FILE__) . 'inc/muu-plugin-activate.php';
require_once plugin_dir_path(__FILE__) . 'inc/muu-plugin-deactivate.php';

// activation
register_activation_hook(__FILE__, ['MuuPluginActivate', 'activate']);

// deactivation 
register_deactivation_hook(__FILE__, ['MuuPluginDeactivate', 'deactivate']);
