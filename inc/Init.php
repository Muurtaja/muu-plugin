<?php
/*
* @package MuuPlugin
*/

namespace Inc;

use Inc\Base\Enqueue;
use Inc\Pages\Admin;

class Init
{

    public static function get_services()
    {
        return [
            Admin::class,
            Enqueue::class,
        ];
    }

    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    public static function instantiate($class)
    {
        $service = new $class();
        return $service;
    }
}
