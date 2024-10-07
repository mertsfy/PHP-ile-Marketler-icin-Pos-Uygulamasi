<?php

require_once __DIR__.'/../init.php';

class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $role;
    public string $password;


    public function getHomePage(): string
    {
        if ($this->role === ROLE_ADMIN) {
            return 'admin_home.php';
        }
        return 'index.php';
    }

    private static $currentUser = null;

    public function __construct($user)
    {
        $this->id = intval($user['id']);
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->role = $user['role'];
        $this->password = $user['password'];
    }

    public static function find($user_id): ?User
    {
        global $connection;

        $stmt = $connection->prepare("SELECT * FROM `users` WHERE id=:id");
        $stmt->bindParam("id", $user_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $stmt->fetchAll();

        return (count($result) >= 1) ? new User($result[0]) : null;
    }

    public static function findByEmail($email): ?User
    {
        global $connection;

        $stmt = $connection->prepare("SELECT * FROM `users` WHERE email=:email");
        $stmt->bindParam("email", $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $stmt->fetchAll();

        return (count($result) >= 1) ? new User($result[0]) : null;
    }

    /**
     * @throws Exception
     */
    public static function login($email, $password): User
    {
        if (empty($email)) throw new Exception("Email zorunlu!");
        if (empty($password)) throw new Exception("Şifre zorunlu!");

        $user = static::findByEmail($email);

        if ($user && $user->password == $password) {
            return $user;
        }

        throw new Exception('Kullanıcı bilgisi hatalı');
    } 
}