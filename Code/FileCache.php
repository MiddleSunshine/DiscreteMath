<?php

class Cache{
    private $fileCachePath='';
    private function __construct()
    {
        $this->fileCachePath=__DIR__.DIRECTORY_SEPARATOR."Cache".DIRECTORY_SEPARATOR."temp.json";
    }
    /**
     * 
     */
    public static function instance(){
        static $instance;
        if(!$instance){
            $instance=new self();
        }
        return $instance;
    }

    public function set($key,$value){
        $content=file_get_contents($this->fileCachePath);
        $content=json_decode($content,1);
        $content[$key]=$value;
        file_put_contents($this->fileCachePath,json_encode($content));
    }

    public function get($key,$defaultValue=''){
        $content=file_get_contents($this->fileCachePath);
        $content=json_decode($content,1);
        return isset($content[$key])?$content[$key]:$defaultValue;
    }
}
