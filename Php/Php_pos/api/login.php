<?php

require_once __DIR__.'/../init.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $email = post('email');
    $password = post('password');

    try {
        $user = User::login($email, $password);
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user'] = $user;
        redirect('../'.$user->getHomePage());
    } catch (Exception $error) {
        flashMessage('login', $error->getMessage());
        redirect('../login.php');
    }
}
