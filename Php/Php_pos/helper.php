<?php

use JetBrains\PhpStorm\NoReturn;

function get($key): string
{
    if (isset($_GET[$key])) return trim($_GET[$key]);
    return "";
}

function post($key): string
{
    if (isset($_POST[$key])) {
        return trim($_POST[$key]);
    }
    return "";
}

#[NoReturn] function redirect($location): void
{
    header("location: $location");
    die();
}

function flashMessage($name, $message): void
{
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }

    $_SESSION[FLASH][$name] = ['message' => $message];
}

function displayFlashMessage($name): void
{

    if (!isset($_SESSION[FLASH][$name])) return;

    $flashMessage = sprintf("<div class='alert alert-warning'>%s</div>", $_SESSION[FLASH][$name]['message']);;

    unset($_SESSION[FLASH][$name]);

    echo $flashMessage;
}