<?php
/*
* @package MuuPlugin
*/


class MuuPluginDeactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
