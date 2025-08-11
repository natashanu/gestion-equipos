<?php
require_once __DIR__ . '/../config/config.php';

class Db
{
    private static $connected = null;
    private string $host;
    private string $db;
    private string $user;
    private string $pass;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->db   = DB;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
    }

    public function getConnection(): PDO
    {
        if (self::$connected === null) {
            try {
                self::$connected = new PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->db,
                    $this->user,
                    $this->pass
                );
                self::$connected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Error de conexión: ' . $e->getMessage();
                exit();
            }
        }
        return self::$connected;
    }

    public function closeConnection(): void
    {
        self::$connected = null;
    }
}
