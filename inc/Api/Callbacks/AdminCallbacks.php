<?php
/*
* @package MuuPlugin
*/

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{

    public function adminDashboard()
    {
        return require_once("{$this->plugin_path}/templates/admin.php");
    }
    public function adminCpt()
    {
        return require_once("{$this->plugin_path}/templates/cpt.php");
    }
    public function adminTaxonomy()
    {
        return require_once("{$this->plugin_path}/templates/taxonomy.php");
    }
    public function adminWidget()
    {
        return require_once("{$this->plugin_path}/templates/widget.php");
    }
    public function muuOptionsGroup($input)
    {
        return $input;
    }
    public function muuSectionGroup()
    {
        echo "Check this beautiful sections!";
    }
    public function muuTextExample()
    {
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" id="text_example" name="text_example" value="' . $value . '" placeholder="Write something here!">';
    }
    public function muuFirstName()
    {
        $value = esc_attr(get_option('first_name'));
        echo '<input type="text" class="regular-text" id="first_name" name="first_name" value="' . $value . '" placeholder="Write something here!">';
    }
}
