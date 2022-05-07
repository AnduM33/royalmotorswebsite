<?php
// Our application namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace app;

// Use Users class from the second level services namespace
use services\Auth;

// Include class autoloader
require 'config.php';

// Instantiate auth class
$auth = new Auth;

// Check if user is already logged in and store it in $authenticated
$authenticated = $auth->checkAuth();

// Set login to null
$login = null;

// If a $_POST is sent and the user is not yet logged in
if (!empty($_POST) && !$authenticated) {
    // Store the POST array content into $data
    $data = $_POST;
    // Login via the login method and store result in $authenticated
    $login = $auth->login($data);
}

// Check if logout has been set
if (isset($_GET['logout'])) {
    $logout = true;
} else {
    $logout = false;
}
?>
<html>
<head></head>
<body>
<main>
        <?php if ($login === true) : ?>
        <h1>Autentificat</h1>
            <?php include 'partials/menu.php'; ?>
        <?php elseif ($logout) : ?>
        <h1>Ai fost deautentificat</h1>
            <?php include 'partials/menu.php'; ?>
        <?php elseif ($login === false) : ?>
        <h1>Parola incorecta</h1>
            <?php include 'partials/menu.php'; ?>
        <?php else : ?>
        <h1>Login</h1>
        <?php include 'partials/menu.php'; ?>
        <form class="form" action="login.php" method="post">
            <div class="form__field">
                <label>Nume utilizator *</label>
                <input name="username" type="text" placeholder="Introdu numele tau de utilizator." 
                required size="20" maxlength="18" min="3">
            </div>
            <div class="form__field">
                <label>Password *</label>
                <input name="password" type="password" placeholder="Introdu parola ta." 
                required size="20" maxlength="18" min="3">
            </div>
            <div class="form__field">
                <button type="submit">Trimite</button>
            </div>
        </form>
        <?php endif; ?>
</main>
</body>
</html>