<?php

require_once __DIR__.'/../init.php';


if (get('action') === 'delete') {
    $id = get('id');
    $category = Category::find($id);

    if ($category){
        $category->delete();
        flashMessage('delete_category', 'Kategori silindi');
    } else {
        flashMessage('delete_category', 'Hata');
    }
    redirect('../category.php');
}


if (post('action') === 'add') {

    $name = post('name');

    try {
        Category::add($name);
        flashMessage('add_category', 'Kategori eklendi');
    } catch (Exception $ex) {
        flashMessage('add_category', $ex->getMessage());
    }

    redirect('../category.php');
}


if (post('action') === 'update') {
    $name = post('name');
    $id = post('id');

    try {
        $category = Category::find($id);
        $category->name = $name;
        $category->update();
        flashMessage('update_category', 'Kategori eklendi');
        redirect('../category.php');
    } catch (Exception $ex) {
        flashMessage('update_category', $ex->getMessage());
        redirect("../category.php?action=update&id={$id}");
    }
}