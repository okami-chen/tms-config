<?php

if (!function_exists('tms_config')) {

    /**
     * 文件名称
     * @param string $name
     * @return []
     */
    function tms_config($name) {
        return \OkamiChen\TmsConfig\Support\Config::env($name);
    }

}

