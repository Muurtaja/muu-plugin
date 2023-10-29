<?php
/*
* @package MuuPlugin
*/


class MuuPluginActivate
{
    public static function activate()
    {
        flush_rewrite_rules();
    }
}
