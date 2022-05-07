<?php
/**
 * Logout
 */
// Our application namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace app;

// Use Users class from the second level services namespace
use services\Auth;

// Include class autoloader
require 'config.php';

// Instantiate users class
$auth = new Auth;

// Get user_id from session if set
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // This should never happen, set a dummy $user_id to prevent erros
    $user_id = 1;
}

// Logout the user
$authenticated = $auth->logout($user_id);

// Redirect to login with message
header("Location: login.php?logout=1");
exit();
