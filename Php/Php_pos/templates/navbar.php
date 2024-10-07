<?php
    $user = $_SESSION['user'];

    if ($user->role == "ADMIN")
        require 'templates/admin_navbar.php';
    else
        require 'templates/cashier_navbar.php';

