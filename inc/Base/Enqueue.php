<?php
/*
* @package MuuPlugin
*/

namespace Inc\Base;

class Enqueue
{
    public function __construct()
    {
    }
    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        wp_enqueue_style('mypluginstyle', PLUGIN_URL . 'assets/css/my-style.css');
        wp_enqueue_script('mypluginscript', PLUGIN_URL . 'assets/js/my-script.js');
    }
}
