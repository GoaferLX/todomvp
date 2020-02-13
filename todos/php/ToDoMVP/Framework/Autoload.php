<?php
namespace GoaferLX\Framework;
class Autoload {
    private $namespaces;
    public function __construct() {
       spl_autoload_register(array($this, 'loadClass'));
    }

    private function loadFile($file) {
        if(file_exists($file)) {
            require_once($file);
            return true;
        }
        return false;
    }

    public function loadClass($class) {
    $namespace = 'GoaferLX';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/../';


    // does the class use the namespace prefix?
    $len = strlen($namespace);
    if (strncmp($namespace, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';

   $this->loadFile($file);
   }
}
?>
