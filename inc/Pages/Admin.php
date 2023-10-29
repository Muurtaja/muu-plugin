<?php
/*
* @package MuuPlugin
*/

namespace Inc\Pages;

use Inc\Base\BaseController;

class Admin extends BaseController
{

    public function register()
    {
        add_action('admin_menu', [$this, 'add_admin_pages']);
    }
    public function add_admin_pages()
    {
        add_menu_page('Muu Plugin', 'Muu', 'manage_options', 'muu_plugin', [$this, 'admin_index'], 'dashicons-store', 110);
    }
    function admin_index()
    {
        require_once "{$this->plugin_path}templates/admin.php";
    }
}
