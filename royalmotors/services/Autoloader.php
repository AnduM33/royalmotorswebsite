<?php
/**
 * Autoload class files on `new` keyword so that we dont have to
 * require every file manually
 */

// Set second-level namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace services;

class Autoloader
{
    /**
     * Dynamically load classes based on classname when `new` is instantiated
     */
    public static function register()
    {
        // Register class loader
        // https://www.php.net/manual/ro/function.spl-autoload-register.php
        spl_autoload_register(function ($class) {
            // Replaces double slash with standard slack (Windows/Linux compatibility)
            // Add .php extension to classname
            // Final file name will be 'services/classname.php
            // https://www.php.net/manual/ro/function.str-replace.php
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
           
            // If the file exists, require class and return true
            if (file_exists($file)) {
                require $file;
                return true;
            }
            
            // Not successful
            return false;
        });
    }
}
