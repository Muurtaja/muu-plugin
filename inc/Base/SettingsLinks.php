<?php
/*
* @package MuuPlugin
*/

namespace Inc\Base;

class SettingsLinks
{
    protected $plugin;

    public function __construct()
    {
        $this->plugin = PLUGIN;
    }
    
    public function register()
    {
        add_filter("plugin_action_links_{$this->plugin}", [$this, 'settings_link']);
    }

    public function settings_link($links = [])
    {

        if (!is_array($links)) $links = [];
        $links[] = '<a href="admin.php?page=muu_plugin">Settings</a>';

        return $links;
    }
}
