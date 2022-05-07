<?php
/**
 * Protected page
 */
// Our application namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace app;

// Use Auth class from the second level services namespace
use services\Auth;

// Include class autoloader
require 'config.php';

// Instantiate auth class
$auth = new Auth;

$logged_in = $auth->checkAuth();

if (!$logged_in) {
    header("Location: login.php");
    exit;
}
?>
<html>
<head></head>
<body>
<main>
    <h1>Protected</h1>
    <?php include 'partials/menu.php'; ?>
</main>
</body>
</html>