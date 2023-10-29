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

use Inc\Base\Activate;
use Inc\Base\Deactivate;
use Inc\Init;

defined('ABSPATH') || die('Hey, you cannot access this file!');
function_exists('add_action') || die('Hey, you cannot access this file!');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


if (class_exists('Inc\\Init')) {
    Init::register_services();
}

register_activation_hook(__FILE__, [Activate::class, 'activate']);
register_deactivation_hook(__FILE__, [Deactivate::class, 'deactivate']);
