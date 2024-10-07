<?php

require_once __DIR__.'/../init.php';

class Category
{
    public $id;
    public $name;

    public function __construct($category)
    {
        $this->id = $category['id'];
        $this->name = $category['name'];
    }

    public function update() 
    {
        global $connection;

        $category = self::findByName($this->name);
        if ($category && $category->id !== $this->id) throw new Exception('Bu kategori mevcut');

        $stmt = $connection->prepare('UPDATE categories SET name=:name WHERE id=:id');
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('id', $this->id);
        $stmt->execute();
    }

    public function delete() {
        global $connection;

        $stmt = $connection->prepare('DELETE FROM categories WHERE id=:id');
        $stmt->bindParam('id', $this->id);
        $stmt->execute();
    }

    public static function all(): array
    {
        global $connection;

        $stmt = $connection->prepare('SELECT * FROM categories');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        return array_map(function($item){ return new Category($item); }, $result);
    }

    public static function add($name)
    {
        global $connection;

        if (static::findByName($name)) throw new Exception('Bu kategori mevcut');

        $stmt = $connection->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->bindParam("name", $name);
        $stmt->execute();
    }

    public static function findByName($name)
    {
        global $connection;

        $stmt = $connection->prepare("SELECT * FROM categories WHERE name=:name");
        $stmt->bindParam("name", $name);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $stmt->fetchAll();

        return (count($result) >= 1) ? new Category($result[0]) : null;
    }

    public static function find($id)
    {
        global $connection;

        $stmt = $connection->prepare("SELECT * FROM categories WHERE id=:id");
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $stmt->fetchAll();

        return (count($result) >= 1) ? new Category($result[0]) : null;
    }
}