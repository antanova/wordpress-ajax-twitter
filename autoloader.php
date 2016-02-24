<?php

namespace Antanova\Wordpress;

class Autoloader
{
    protected $prefix = 'Antanova\\Wordpress\\';
    
    protected $path;
    
    static $instance;
    
    public static function init($path)
    {
        self::$instance = new self($path);
    }
    
    function __construct($path)
    {
        $this->path = $path;
        spl_autoload_register(array($this, 'autoload'));
    }
    
    public function autoload($class)
    {
        // Is it within our namespace?
        if (strpos($class, $this->prefix) !== 0) {
            return;
        }
        $className = substr($class, strpos($this->prefix, $class) + strlen($this->prefix));
        
        if (file_exists($this->path . DIRECTORY_SEPARATOR . $className . '.php')) {
            require_once( $this->path . DIRECTORY_SEPARATOR . $className . '.php');
        }
    }
}