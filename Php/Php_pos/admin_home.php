<?php

require_once 'init.php';

$products = Product::all();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ana Sayfa</title>
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
            <div class="col">
                <span class="h5">Ürün Listesi</span>
                <hr/>

                <?php displayFlashMessage('delete_product') ?>
                <?php displayFlashMessage('add_stock') ?>

                <table id="productsTable" class="table table-hover">
                    <thead>
                    <tr class="table-info">
                        <th>Ürün Adı</th>
                        <th>Kategori</th>
                        <th>Stok Adedi</th>
                        <th>Fiyat</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product->name ?></td>
                        <td><?= $product->category->name ?></td>
                        <td><?= $product->quantity ?></td>
                        <td><?= $product->price ?></td>
                        <td>
                            <a href="#" onclick="addStock(<?= $product->id ?>)" class="text-green-300">Stok Ekle</a>
                            <a href="product_update.php?id=<?= $product->id ?>"
                               class="text-primary ml-16">Güncelle</a>
                            <a href="api/product.php?action=delete&id=<?= $product->id ?>"
                               class="text-red-500 ml-16">Sil</a>
                        </td>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

</body>
</html>