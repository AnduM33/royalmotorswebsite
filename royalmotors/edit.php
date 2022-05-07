<?php
/**
 * Register
 */

// Our application namespace
// https://www.php.net/manual/ro/language.namespaces.php
namespace app;

// Use Auth, Users class from the second level services namespace
use services\Auth;
use services\Users;

// Include class autoloader
require 'config.php';

// Instantiate auth,users class
$auth = new Auth;
$users = new Users;

// Set edited to false
$authenticated = $auth->checkAuth();

// Get user id from GET
if (isset($_GET['user_id'])) {
    $user = $users->getUser($_GET['user_id']);
} else {
    $user = false;
}

// Set default value
$edited = false;

// If POST data not empty and not registered
if (!empty($_POST) & $authenticated) {
    // Store post data in array
    $data = $_POST;
    // Edit user and store result
    $edited = $users->editUser($data);
}
?>
<html>
<head></head>
<body>
<main>
        <?php if ($edited) : ?>
        <h2>Editare completa</h2>
            <?php include 'partials/menu.php'; ?>
        <?php else : ?>
        <h1>Editare</h1>
            <?php include 'partials/menu.php'; ?>
        <form class="form" action="edit.php" method="post">
            <div class="form__field">
                <label>Prenume *</label>
                <input name="first_name" type="text" placeholder="Introdu prenumele tau." required size="20" 
                maxlength="18" pattern="[^0-9][A-Za-z]{2,20}" min="3" value="<?php echo $user->first_name; ?>">
            </div>
            <div class="form__field">
                <label>Prenume *</label>
                <input name="last_name" type="text" placeholder="Introdu numele tau." required size="20" 
                maxlength="18" pattern="[^0-9][A-Za-z]{2,20}" min="3" value="<?php echo $user->last_name;?>">
            </div>
            <div class="form__field">
                <label>Email *</label>
                <input name="email" type="email" placeholder="Introdu email-ul tau." required size="20" 
                maxlength="30" min="3" value="<?php echo $user->email; ?>">
            </div>
            <div class="form__field">
                <label>Nume utilizator *</label>
                <input name="username" type="text" placeholder="Introdu numele tau de utilizator." 
                required size="20" maxlength="18" min="3" value="<?php echo $user->username; ?>">
            </div>
            <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
            <div class="form__field">
                <button type="submit">Trimite</button>
            </div>
        </form>
        <?php endif; ?>
</main>
</body>
</html>