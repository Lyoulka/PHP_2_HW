<?php
namespace engine;
class Autoloader
{
    private $root = "app\\";
    function loadClass($className)
    {
        $className = str_replace($this->root, "", $className);
        $filename =  $className . '.php';
        if (file_exists($filename)) {
            require_once($filename);
        }
    }
}