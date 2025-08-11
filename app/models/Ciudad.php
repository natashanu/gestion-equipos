<?php
require_once "Db.php";

class Ciudad
{
    private PDO $connection;
    private string $table = "ciudades";
    private int $id;
    private string $nombre;

    public function __construct()
    {
        $db = new Db();
        $this->connection = $db->getConnection();
    }

    public function getCiudades()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCiudadPorId(int $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getId(): int
    {
        return (int)$this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
}
