<?php

require_once 'config.php';
require_once'helper.php';
require_once 'models/user.php';
require_once 'models/category.php';
require_once 'models/product.php';
require_once 'models/order.php';
require_once 'models/orderItem.php';
require_once 'models/sales.php';

session_start();

try{
    $connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    header('Content-type: text/plain');

    die("
        Hata: Veritabanına bağlanma hatası
        Neden: {$e->getMessage()}
    ");
}