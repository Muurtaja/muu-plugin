<?php
/*
* @package MuuPlugin
*/

namespace Inc\Api;

class SettingsApi
{
    public $admin_pages     = [];
    public $admin_sub_pages = [];
    public $settings        = [];
    public $sections        = [];
    public $fields          = [];
    public function register()
    {
        if (!empty($this->admin_pages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }
        if (!empty($this->settings)) {
            add_action('admin_init', [$this, 'registerCustomFields']);
        }
    }
    public function addPages(array $pages)
    {
        $this->admin_pages = $pages;
        return $this;
    }
    public function addSubPage(array $sub_pages)
    {
        $this->admin_sub_pages = array_merge($this->admin_sub_pages, $sub_pages);
        return $this;
    }
    public function withSubPage(string $title = null)
    {
        if (empty($this->admin_pages)) {
            return $this;
        }

        $admin_page  = $this->admin_pages[0];

        $sub_pages = [
            [
                'parent_slug' => $admin_page['menu_slug'],
                'page_title'  => $admin_page['page_title'],
                'menu_title'  => $title ?? $admin_page['menu_title'],
                'capability'  => $admin_page['capability'],
                'menu_slug'   => $admin_page['menu_slug'],
                'callback'    => $admin_page['callback'],
            ]
        ];

        $this->admin_sub_pages = array_merge($this->admin_sub_pages, $sub_pages);
        return $this;
    }
    public function addAdminMenu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }
        foreach ($this->admin_sub_pages as $subPage) {
            add_submenu_page($subPage['parent_slug'], $subPage['page_title'], $subPage['menu_title'], $subPage['capability'], $subPage['menu_slug'], $subPage['callback']);
        }
    }


    public function setSettings(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);
        return $this;
    }
    public function setSections(array $sections)
    {
        $this->sections = array_merge($this->sections, $sections);
        return $this;
    }
    public function setFields(array $fields)
    {
        $this->fields = array_merge($this->fields, $fields);
        return $this;
    }

    public function registerCustomFields()
    {

        // register setting
        foreach ($this->settings as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], (isset($setting['callback']) ? $setting['callback'] : null));
        }
        // add settings section
        foreach ($this->sections as $section) {
            add_settings_section($section['id'], $section['title'], (isset($section['callback']) ? $section['callback'] : null), $section['page']);
        }

        // add settings fields
        foreach ($this->fields as $field) {
            add_settings_field($field['id'], $field['title'], (isset($field['callback']) ? $field['callback'] : null), $field['page'], $field['section'], (isset($field['args']) ? $field['args'] : null));
        }
    }
}
