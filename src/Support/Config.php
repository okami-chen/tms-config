<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OkamiChen\TmsConfig\Support;

use Symfony\Component\Yaml\Yaml;

/**
 * Description of Config
 * @date 2018-7-20 14:52:21
 * @author dehua
 */
class Config {
    
    /**
     * 
     * @param string $file
     * @param string $key
     * @return array
     */
    static public function load($file, $key=null){

        if(!file_exists($file)){
            return [];
        }
        
        if(!is_readable($file)){
            return [];
        }
        
        $config = Yaml::parseFile($file);
        if($key){
            return array_get($config, $key);
        }
        return $config;
    }
    
    /**
     * 
     * @param string $name
     * @return []
     */
    static public function env($name){
        $path   = base_path('yaml') .'/'.env('APP_ENV').'/'. $name .'.yml';
        return self::load($path);
    }

    /**
     * 
     * @param string $from
     * @param string $to
     * @return boolean
     */
    static public function arrayToYaml($from, $to){
        
        if(!file_exists($from)){
            return false;
        }
        
        $content = include $from;
        $config  = Yaml::dump($content, 4);
        return file_put_contents($to, $config);
    }
}
