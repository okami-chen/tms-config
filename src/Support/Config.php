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
    
    static $files = [];
    
    /**
     * 
     * @param string $file
     * @param string $key
     * @param string $default
     * @return array
     */
    static public function load($file, $key=null, $default=null){

        if(!file_exists($file)){
            return [];
        }
        
        if(!is_readable($file)){
            return [];
        }
        
        $cacheKey   = md5($file);
        
        if(isset(static::$files[$cacheKey])){
            $config = static::$files[$cacheKey];
        }else{
            $config = Yaml::parseFile($file);
            if(count($config)){
                static::$files[$cacheKey] = $config;
            }
        }
        
        if($key){
            return array_get($config, $key, $default);
        }
        return $config;
    }
    
    /**
     * 
     * @param string $name
     * @param string $key
     * @param string $default
     * @return []
     */
    static public function env($name, $key=null, $default=null){
        $path   = base_path('yaml') .'/'.env('APP_ENV').'/'. $name .'.yml';
        return self::load($path, $key, $default);
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
