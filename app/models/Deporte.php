<?php
require_once "Db.php";

class Deporte{
    private string $table = "deportes";
    private int $id;
    private string $nombre;

    public function __construct(){
        $db = new Db();
        $this->conection = $db->getConnection();
    }

    public function getCiudades(){
        $sql = "SELECT * FROM {$this->table}";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeportePorId(int $id){
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([':id'=> $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
?>