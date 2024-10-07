<?php

require_once 'init.php';

$categories = Category::all();

$category = null;
if (get('action') === 'update') {
    $category = Category::find(get('id'));
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kategoriler</title>
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
            <div class="col-4">
                        <span class="h5">
                            <?php if (get('action') === 'update') : ?>
                                Kategori Güncelleme
                            <?php else : ?>
                                Yeni Kategori Ekleme
                            <?php endif; ?>
                        </span>
                <hr/>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="api/category.php">

                            <input type="hidden" name="action"
                                   value="<?= get('action') === 'update' ? 'update' : 'add' ?>"/>

                            <input type="hidden" name="id" value="<?= $category?->id ?>"/>

                            <div>
                                <label class="form-label">Kategori Adı</label>
                                <input
                                    class="form-control"
                                    value="<?= $category?->name ?>"
                                    type="text"
                                    name="name"
                                    required="true"
                                />
                            </div>

                            <div class="h-100 d-flex align-items-center justify-content-center mt-3">
                                <button class="btn btn-primary w-50" type="submit">Kaydet</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <div class="col-7">
                <span class="h5">Kategory Listesi</span>
                <hr/>

                <?php displayFlashMessage('add_category') ?>
                <?php displayFlashMessage('delete_category') ?>
                <?php displayFlashMessage('update_category') ?>

                <table id="categoryTable" class="table table-hover">
                    <thead>
                    <tr class="table-info">
                        <th>Kategori Adı</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?= $category->name ?></td>
                            <td>
                                <a class="text-primary"
                                   href="?action=update&id=<?= $category->id ?>">Güncelle</a>
                                <a class="text-red-500 ml-16"
                                   href="api/category.php?action=delete&id=<?= $category->id ?>">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</body>
</html>