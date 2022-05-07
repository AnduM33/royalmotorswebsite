<?php
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

    // Call getAll method
    $records = $users->getAll();

    // Check if user is authenticated
    $authenticated = $auth->checkAuth();
?>
<?php

// Show deleted message if $_GET['deleted'] is set and user is autenticated
if (isset($_GET['deleted']) && $authenticated) {
    $user_id = $_GET['deleted'];
    echo "<em>User with ID {$user_id} was deleted.</em><br><br>";
}

// Show permission denied message if $_GET['denied'] is set
if (isset($_GET['denied'])) {
    echo "<em>Permission denied.</em><br><br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Motors Auction House</title>

    <link rel="stylesheet" href="style.css">

    <script type=module src="template.js"></script>
    <?php include "header.php";?>
</head>
<body>
    <div class="background-image">
        <img src="images/HomeBackground.jpg">
    </div>

    
</body>
<footer>
    <?php include "footer.php";?>
</footer>
</html>