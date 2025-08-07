<?php 
require_once "Db.php";
require_once "Ciudad.php";
require_once "Deporte.php";

class Equipo{
    private PDO $conection;
    private string $table = "equipos";
    private string $nombre;
    private int $idCiudad;
    private int $idDeporte;
    private string $fechaFundacion;

    public function __construct(){
        $db = new Db();
        $this->conection = $db->getConnection();
    }

    public function getEquipos(){
        $sql = "SELECT * FROM {$this->table}";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEquipoPorId(int $id){
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([':id'=> $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function save() {
        $sql = "INSERT INTO equipos (nombre, idCiudad, idDeporte, fechaFundacion) VALUES (:nombre, :idCiudad, :idDeporte, :fechaFundacion)";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([
            ':nombre' => $this->nombre,
            ':idCiudad' => $this->idCiudad,  
            ':idDeporte' => $this->idDeporte,
            ':fechaFundacion' => $this->fechaFundacion
        ]);
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getCiudad(): string {
        $ciudad = new Ciudad();
        $ciudadData = $ciudad->getCiudadPorId($this->idCiudad);
        return $ciudadData['nombre'] ?? null;    }

    public function getDeporte(): string {
        return $this->deporte;
    }

    public function getFechaFundacion(): string {
        return $this->fechaFundacion;
    }

}