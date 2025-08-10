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
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $equipos = [];

        foreach ($rows as $row) {
            $equipo = new self();
            $equipo->id = $row['id'];
            $equipo->nombre = $row['nombre'];
            $equipo->idCiudad = $row['id_ciudad'];
            $equipo->idDeporte = $row['id_deporte'];
            $equipo->fechaFundacion = $row['fecha_fundacion'];
            $equipos[] = $equipo;
        }

        return $equipos;
    }

    public function getEquipoPorId($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([':id'=> $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $equipo = new self(); 
        $equipo->id = $data['id']; 
        $equipo->nombre = $data['nombre'];
        $equipo->idCiudad = $data['id_ciudad'];
        $equipo->idDeporte = $data['id_deporte'];
        $equipo->fechaFundacion = $data['fecha_fundacion'];

        return $equipo;   
    }

    public function save() {
        $sql = "INSERT INTO equipos (nombre, id_ciudad, id_deporte, fecha_fundacion) VALUES (:nombre, :idCiudad, :idDeporte, :fechaFundacion)";
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
        return $ciudadData['nombre'] ?? null;
    }

    public function getDeporte(): string {
        $deporte = (new Deporte())->getDeportePorId($this->idDeporte);
        return $deporte['nombre'] ?? null;
    }

    public function getFechaFundacion(): string {
        return $this->fechaFundacion;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setIdCiudad(int $idCiudad): void {
        $this->idCiudad = $idCiudad;
    }

    public function setIdDeporte(int $idDeporte): void {
        $this->idDeporte = $idDeporte;
    }

    public function setFechaFundacion(string $fecha): void {
        $this->fechaFundacion = $fecha;
    }


}