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
    <script src="./js/cashier.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body>

<?php require 'templates/admin_header.php' ?>

<div class="d-flex">
    <?php require 'templates/navbar.php' ?>
    <div class="container" x-data='products(<?= json_encode($products) ?>)'>
        <div class="row">
            <div class="col-6">
                <div class="h5">Ürünler</div>
                <hr/>

                <?php displayFlashMessage('transaction') ?>

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
                                <a @click="addToCart(<?= $product->id ?>)" href="#"
                                   class="text-primary ink-underline-light link-opacity-50">Ekle</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column h-100">
                    <div>
                        <div class="h5">Sepet</div>
                        <hr/>
                    </div>

                    <div id="cardItemsContainer" class="d-flex flex-column mb-5">
                        <template x-for="cart in carts">
                            <div class="container">
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <span x-text="cart.product.name"></span>
                                    </div>
                                    <div class="col-3">
                                        <div class="cart-item-buttons">
                                            <button class="btn btn-secondary" @click="subtractQuantity(cart)">-</button>
                                            <span x-text="cart.quantity"></span>
                                            <button class="btn btn-secondary" @click="addQuantity(cart)">+</button>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end">
                                        <span class="right" x-text="(cart.quantity * cart.product.price)"></span>
                                    </div>
                                </div>
                        </template>
                    </div>

                    <form action="api/cashier.php" method="POST" @submit="validate">

                        <input type="hidden" name="action" value="proccess_order">

                        <template x-for="(cart,i) in carts" :key="cart.product.id">
                            <div>
                                <input type="hidden" :name="`cart_item[${i}][id]`" :value="cart.product.id">
                                <input type="hidden" :name="`cart_item[${i}][quantity]`" :value="cart.quantity">
                            </div>
                        </template>

                        <div class="row">
                            <div class="col-8">
                                <span>Toplam Tutar: </span>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <span class="h6 mr-3" x-text="totalPrice"></span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <span>Ödenen: </span>
                            </div>
                            <div class="col-4">
                                <input type="number" x-model="payment" step="1" name="" class="form-control"/>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                <button type="button" @click="calculateChange" class="btn btn-warning">Hesapla
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <span>Para Üstü: </span>
                            </div>
                            <div class="col-4">
                                <span class="h6" x-ref="change">--</span>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-5 w-100">Ödeme</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>