<?php
require_once __DIR__ .'/../models/Ciudad.php';
require_once __DIR__ .'/../models/Deporte.php';
require_once __DIR__ .'/../models/Equipo.php';
require_once __DIR__ .'/../lib/Control.php';
require_once __DIR__ .'/../helpers/validation.php';

class EquiposController extends Control{
    private Equipo $equipoObj;

    public function __construct() {
        $this->equipoObj = new Equipo();
    }

    public function index() {
        $equipos = $this->equipoObj->getEquipos();
        $this->load_view('equipos/index', ['equipos' => $equipos]);
    }

    public function mostrar($id) {
        $equipo = $this->equipoObj->getEquipoPorId($id);
        $equipo->cargarJugadores();
        $jugadores = $equipo->getJugadores();
        $this->load_view('equipos/detalles', ['equipo' => $equipo, 'jugadores' => $jugadores]);
    }

    public function anadir(){
        $ciudades = (new Ciudad())->getCiudades();
        $deportes = (new Deporte())->getDeportes();
        $this->load_view('equipos/anadir', ['deportes' => $deportes, 'ciudades' => $ciudades]);
    }

    public function guardar() {
        $reglas = [
            'nombre' => ['required','string', 'max:255'],  
            'ciudad' => ['required'],
            'deporte' => ['required'],
            'fecha_fundacion' => ['required', 'date:Y-m-d'],
        ];

        if (validarCampos($_POST, $reglas)) {
            $this->equipoObj->setNombre($_POST['nombre'] ?? NULL);
            $this->equipoObj->setIdCiudad($_POST['ciudad'] ?? NULL);
            $this->equipoObj->setIdDeporte($_POST['deporte'] ?? NULL);
            $this->equipoObj->setFechaFundacion($_POST['fecha_fundacion'] ?? NULL);

            $id_equipo = $this->equipoObj->create();
            if($id_equipo){
                header("Location: " . BASE_URL . "/equipos/mostrar/".$id_equipo);
                exit;
            }
            header("Location: " . BASE_URL . "/equipos");
            exit;
        } else {
            $errores = getErrores();
            $ciudades = (new Ciudad())->getCiudades();
            $deportes = (new Deporte())->getDeportes();

            $this->load_view('equipos/anadir', [
                'ciudades' => $ciudades,
                'deportes' => $deportes,
                'errores' => $errores,
                'datos' => $_POST,
            ]);
        }
    }
}
