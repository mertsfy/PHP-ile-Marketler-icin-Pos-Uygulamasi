<?php

require_once 'init.php';

$product = Product::find(get('id'));
$categories = Category::all();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ürün Güncelleme</title>
    <link rel="stylesheet" type="text/css" href="./css/main.css"">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php require 'templates/admin_header.php' ?>

<div class="d-flex">
    <?php require 'templates/navbar.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="h5">Ürün Güncelleme</div>
                <hr/>

                <div class="card">
                    <div class="card-body">
                        <form method="POST"
                              action="api/product.php?action=update&id=<?= $product->id ?>">

                            <?php displayFlashMessage('update_product') ?>

                            <div>
                                <label class="form-label">Ürün Adı</label>
                                <input
                                    class="form-control"
                                    value="<?= $product->name ?>"
                                    type="text"
                                    name="name"
                                    required=""
                                />
                            </div>

                            <div class="mt-2">
                                <label class="form-label">Kategori</label>
                                <select name="category_id" required="" class="form-control">
                                    <option value=""> -- Kategori Seç --</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option
                                            value="<?= $category->id ?>"
                                            <?= $category->id === $product->category_id ? 'selected' : '' ?>
                                        ><?= $category->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mt-2">
                                <label class="form-label">Fiyat</label>
                                <input
                                    class="form-control"
                                    value="<?= $product->price ?>"
                                    required=""
                                    type="number"
                                    name="price"
                                />
                            </div>

                            <div class="h-100 d-flex align-items-center justify-content-center mt-3">
                                <button class="btn btn-primary w-50" type="submit">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>