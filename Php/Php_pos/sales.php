<?php

require_once 'init.php';

$todaySales = Sales::getTodaySales();
$totalSales = Sales::getTotalSales();
$transactions = OrderItem::all();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Satışlar</title>
    <link rel="stylesheet" type="text/css" href="./css/main.css"">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="./js/main.js"></script>

</head>
<body>
<?php require 'templates/admin_header.php' ?>

<div class="d-flex">
    <?php require 'templates/navbar.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="h5">Satış Bilgileri</div>
                <hr/>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title h6">Günlük Satış</div>
                    </div>
                    <div class="card-body">
                        <?= $todaySales ?>
                    </div>
                </div>

                <div class="card mt-16">
                    <div class="card-header">
                        <div class="card-title h6">Toplam Satış</div>
                    </div>
                    <div class="card-body">
                        <?= $totalSales ?>
                    </div>
                </div>
            </div>

            <div class="col-7">
                <div class="h5">İşlemler</div>
                <hr/>

                <table id="transactionsTable" class="table table-hover">
                    <thead>
                    <tr class="table-info">
                        <td>Ürün Adı</td>
                        <td>Adet</td>
                        <td>Fiyat</td>
                        <td>Tutar</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($transactions

                    as $transaction) : ?>
                    <tr>
                        <td><?= $transaction->product_name ?></td>
                        <td><?= $transaction->quantity ?></td>
                        <td><?= $transaction->price ?></td>
                        <td><?= $transaction->quantity * $transaction->price ?></td>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>