<?php
require_once "Db.php";

class Ciudad{
    private string $table = "ciudades";
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

    public function getCiudadPorId(int $id){
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([':id'=> $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
?>