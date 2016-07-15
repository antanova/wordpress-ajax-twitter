<?php

namespace Antanova\Wordpress;

class autoloader
{
    protected $prefix = 'Antanova\\Wordpress\\';

    protected $path;

    public static $instance;

    public static function init($path)
    {
        self::$instance = new self($path);
    }

    public function __construct($path)
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
        $className = strtr($className, '\\', '/');

        if (file_exists($this->path.DIRECTORY_SEPARATOR.$className.'.php')) {
            require_once $this->path.DIRECTORY_SEPARATOR.$className.'.php';
        }
    }
}
