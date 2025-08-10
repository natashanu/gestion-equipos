<?php 
require_once "Db.php";
require_once "Equipo.php";

class Jugador{
    private PDO $conection;
    private string $table = "jugadores";
    private string $id;
    private string $nombre;
    private int $numero;
    private Equipo $equipo;

    public function __construct(){
        $db = new Db();
        $this->conection = $db->getConnection();
    }

    /**
     * @param int|null $id del equipo en el que participa algún juagdor.
     * @return array|null Jugadores del equipo.
     */
    public function getJugadoresPorEquipo($id){
        $sql = "SELECT * FROM {$this->table} WHERE id_equipo = :id";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([":id" => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jugadores = [];

        foreach ($rows as $row) {
            $jugador = new self();
            $jugador->id = $row['id'];
            $jugador->nombre = $row['nombre'];
            $jugador->numero = $row['numero'];
            $jugador->equipo = (new Equipo)->getEquipoPorId($row['id_equipo']);
            $jugadores[] = $jugador;
        }

        return $jugadores;
    }

    public function getJugadorPorId($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([':id'=> $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $jugador = new self(); 
        $jugador->id = $data['id']; 
        $jugador->nombre = $data['nombre'];
        $jugador->numero = $data['numero'];
        $jugador->equipo = (new Equipo)->getEquipoPorId($data['id_equipo']);

        return $jugador;   
    }

    public function create() {
        $sql = "INSERT INTO {$this->table} (nombre, numero, id_equipo) VALUES (:nombre, :numero, :idEquipo)";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([
            ':nombre' => $this->nombre ?? null,
            ':numero' => $this->numero ?? null,   
            ':idEquipo' => $this->equipo ? $this->equipo->getId() : null      
        ]);
    }

    public function update() {
        $sql = <<<SQL
                    UPDATE {$this->table} SET
                    nombre = :nombre, 
                    numero = :numero
                    WHERE id = :idJugador
                SQL;
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([
            ':nombre' => $this->nombre ?? null,
            ':numero' => $this->numero ?? null,   
            ':idJugador' => $this->id ?? null     
        ]);

        return $stmt->rowCount() > 0;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getNumero(): string {
        return $this->numero;
    }

    public function getEquipo(): Equipo {
        return $this->equipo;
    }

    public function setNombre(string $nombre) {
        $this->nombre = $nombre;
    }

    public function setNumero(string $numero) {
        $this->numero = $numero;
    }

    public function setEquipo(Equipo $equipo) {
        $this->equipo = $equipo;
    }

}