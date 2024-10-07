<?php

require_once __DIR__.'/../init.php';

class Product 
{
    public $id;
    public $name;
    public $category_id;
    public $quantity;
    public $price;
    public $category;

    public function __construct($product)
    {
        $this->category = $this->getCategory($product);
        $this->id = $product['id'];
        $this->name = $product['name'];
        $this->category_id = $product['category_id'];
        $this->quantity = intval($product['quantity']);
        $this->price = floatval($product['price']);
    }

    public function update(): void
    {
        global $connection;

        $stmt = $connection->prepare('UPDATE products SET name=:name, category_id=:category_id, quantity=:quantity, price=:price WHERE id=:id');
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('category_id', $this->category_id);
        $stmt->bindParam('quantity', $this->quantity);
        $stmt->bindParam('price', $this->price);
        $stmt->bindParam('id', $this->id);
        $stmt->execute();
    }

    public function delete(): void
    {
        global $connection;

        $stmt = $connection->prepare('DELETE FROM products WHERE id=:id');
        $stmt->bindParam('id', $this->id);
        $stmt->execute();
    }

    private function getCategory($product): ?Category
    {
        return Category::find($product['category_id']);
    }

    public static function all(): array
    {
        global $connection;

        $stmt = $connection->prepare('SELECT products.*, categories.name as category_name FROM products INNER JOIN categories ON products.category_id = categories.id');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

       return array_map(fn($item) => new Product($item), $result);
    }

    public static function find($id): ?Product
    {
        global $connection;

        $stmt = $connection->prepare('SELECT products.*, categories.name as category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.id=:id');
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        return (count($result) >= 1) ? new Product($result[0]) : null;
    }

    public static function add($name, $category_id, $quantity, $price): void
    {
        global $connection;

        $sql_command = 'INSERT INTO products (name, category_id, quantity, price) VALUES (:name, :category_id, :quantity, :price)';
        $stmt = $connection->prepare($sql_command);
        $stmt->bindParam('name', $name);
        $stmt->bindParam('category_id', $category_id);
        $stmt->bindParam('quantity', $quantity);
        $stmt->bindParam('price', $price);
        $stmt->execute();
    }
}