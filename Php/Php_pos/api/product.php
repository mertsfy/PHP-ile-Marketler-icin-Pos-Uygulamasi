<?php
require_once __DIR__.'/../init.php';

if (get('action') === 'add') {
    $name = post('name');
    $category_id = post('category_id');
    $quantity = post('quantity');
    $price = post('price');

    try {
        Product::add($name, $category_id, $quantity, $price);
        flashMessage('add_product', 'Ürün eklendi');
    } catch (Exception $ex) {
        flashMessage('add_product', $ex->getMessage());
    }
    redirect('../product_add.php');
}

if (get('action') === 'delete') {
    $id = get('id');

    Product::find($id)?->delete();

    flashMessage('delete_product', 'Ürün silindi');
    redirect('../admin_home.php');
}

if (get('action') === 'update') {
    $product = Product::find(get('id'));;
    $product->name = post('name');
    $product->category_id = post('category_id');
    $product->price = post('price');
    $product->update();

    flashMessage('update_product', 'Ürün güncellendi');
    redirect('../product_update.php?id='.$product->id);
}

if (get('action') === 'add_stock') {
    $product = Product::find(get('id'));;
    $product->quantity += get('quantity');
    $product->update();

    flashMessage('add_stock', "Ürün stok adedi güncellendi");
    redirect('../admin_home.php');
}