<?php
/**
 * Delete
 */
// Our application namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace app;

// Use Users, Auth class from the second level services namespace
use services\Users;
use services\Auth;

// Include class autoloader
require 'config.php';

// Instantiate users, auth class
$users = new Users;
$auth = new Auth;

// Check if user is authenticated
$authenticated = $auth->checkAuth();

// Get user_id from GET and check if user is authenticated
if (isset($_GET['user_id']) && $authenticated) {
    $user_id = $_GET['user_id'];

    // Delete the user
    $deleted = $users->deleteUser($user_id);

    // Redirect to login with message
    header("Location: index.php?deleted={$user_id}");
    exit();
} else {
    // Redirect to login with message
    header("Location: index.php?denied=1");
    exit();
}
