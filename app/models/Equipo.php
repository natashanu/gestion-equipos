<?php 
require_once "Ciudad.php";
require_once "Db.php";
require_once "Deporte.php";
require_once "Jugador.php";

class Equipo{
    private PDO $conection;
    private string $table = "equipos";
    private string $id;
    private string $nombre;
    private int $idCiudad;
    private int $idDeporte;
    private ?Jugador $capitan = null;
    private array $jugadores = [];
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

            if (!empty($row['id_capitan'])) {
                $equipo->capitan = (new Jugador())->getJugadorPorId($row['id_capitan']);
            } else {
                $equipo->capitan = null;
            }

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

        if (!empty($data['id_capitan'])) {
            $equipo->capitan = (new Jugador())->getJugadorPorId($data['id_capitan']);
        } else {
            $equipo->capitan = null;
        }

        return $equipo;   
    }

    public function cargarJugadores(): void {
        $this->jugadores = (new Jugador())->getJugadoresPorEquipo($this->id);
    }

    public function create() {
        $sql = "INSERT INTO equipos (nombre, id_ciudad, id_deporte, fecha_fundacion) VALUES (:nombre, :idCiudad, :idDeporte, :fechaFundacion)";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([
            ':nombre' => $this->nombre,
            ':idCiudad' => $this->idCiudad,  
            ':idDeporte' => $this->idDeporte,
            ':fechaFundacion' => $this->fechaFundacion
        ]);

        return (int) $this->conection->lastInsertId();
    }

    public function update() {
        $sql = <<<SQL
                    UPDATE {$this->table} SET
                    nombre = :nombre, 
                    id_ciudad = :idCiudad,
                    id_deporte = :idDeporte,
                    fecha_fundacion = :fechaFundacion,
                    id_capitan = :idCapitan
                    WHERE id = :idEquipo
                SQL;
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([
            ':nombre' => $this->nombre ?? null,
            ':idCiudad' => $this->idCiudad ?? null,  
            ':idDeporte' => $this->idDeporte ?? null,
            ':fechaFundacion' => $this->fechaFundacion ?? null,
            ':idCapitan' => $this->capitan ? $this->capitan->getId() : null ,     
            ':idEquipo' => $this->id      
        ]);

        return $stmt->rowCount() > 0;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getCiudad(): string {
        $ciudad = (new Ciudad())->getCiudadPorId($this->idCiudad);
        return $ciudad['nombre'] ?? null;
    }

    public function getDeporte(): string {
        $deporte = (new Deporte())->getDeportePorId($this->idDeporte);
        return $deporte['nombre'] ?? null;
    }

    public function getCapitan(): ?Jugador {
        return $this->capitan ?? null;
    }

    public function getJugadores(): array {
        return $this->jugadores;
    }

    public function getFechaFundacion(): string {
        return $this->fechaFundacion;
    }

    public function setId(string|null $id): void {
        $this->id = $id;
    }

    public function setNombre(string|null $nombre): void {
        $this->nombre = $nombre;
    }

    public function setIdCiudad(int|null $idCiudad): void {
        $this->idCiudad = $idCiudad;
    }

    public function setIdDeporte(int|null $idDeporte): void {
        $this->idDeporte = $idDeporte;
    }

    public function setFechaFundacion(string|null $fecha): void {
        $this->fechaFundacion = $fecha;
    }

    public function setCapitan(Jugador|null $capitan): void {
        $this->capitan = $capitan;
    }

}