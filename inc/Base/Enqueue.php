<?php
/*
* @package MuuPlugin
*/

namespace Inc\Base;

class Enqueue
{

    protected $plugin_url;

    public function __construct()
    {
        $this->plugin_url = PLUGIN_URL;
    }


    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        wp_enqueue_style('mypluginstyle', "{$this->plugin_url}assets/css/my-style.css");
        wp_enqueue_script('mypluginscript',  "{$this->plugin_url}assets/js/my-script.js");
    }
}
