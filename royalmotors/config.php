<?php
// Our application namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace app;

// Use Autoload class from the second level services namespace
use services\Autoloader;

// Require class autoloader
require 'services/Autoloader.php';

// Database
define('DB_DATABASE', 'users');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

// Start autoloader
Autoloader::register();

// Start session
session_start();
