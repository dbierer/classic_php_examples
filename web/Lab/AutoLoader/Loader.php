<?php
namespace Lab\AutoLoader;

class Loader
{
    protected $path = array();
    public function __construct($path)
    {
        if (is_array($path)) {
            $this->path = $path;
        } else {
            $this->path[] = $path;
        }
        spl_autoload_register([$this, 'loadFromPath']);
    }
    public function loadFromPath($class)
    {
        $filename = str_ireplace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        foreach ($this->path as $dir) {
            $fullName = $dir . DIRECTORY_SEPARATOR . $filename;
            if (file_exists($fullName)) {
                require_once $fullName;
                break;
            }
        }
    }
    public function addToPath($dir)
    {
        $this->path[] = $dir;
    }
}
