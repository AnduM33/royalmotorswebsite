<?php
/**
 * Register
 */

// Our application namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace app;

// Use Auth class from the second level services namespace
use services\Users;

// Include class autoloader
require 'config.php';

// Instantiate auth class
$user = new Users;

// Set registered to false
$registered = false;

// If POST data not empty and not registered
if (!empty($_POST) & !$registered) {
    // Store post data in array
    $data = $_POST;
    // Register user and store result
    $registered = $user->AddUser($data);
}
?>
<html>
<head></head>
<body>
<main>
        <?php if ($registered) : ?>
        <h2>Inregistrare completa</h2>
            <?php include 'partials/menu.php'; ?>
        <?php else : ?>
        <h1>Inregistrare</h1>
            <?php include 'partials/menu.php'; ?>
        <form class="form" action="register.php" method="post">
            <div class="form__field">
                <label>Prenume *</label>
                <input name="first_name" type="text" placeholder="Introdu prenumele tau." required size="20" 
                maxlength="18" pattern="[^0-9][A-Za-z]{2,20}" min="3">
            </div>
            <div class="form__field">
                <label>Prenume *</label>
                <input name="last_name" type="text" placeholder="Introdu numele tau." required size="20" 
                maxlength="18" pattern="[^0-9][A-Za-z]{2,20}" min="3">
            </div>
            <div class="form__field">
                <label>Email *</label>
                <input name="email" type="email" placeholder="Introdu email-ul tau." required size="20" 
                maxlength="30" min="3">
            </div>
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