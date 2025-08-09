<?php
require_once __DIR__ .'/../models/Ciudad.php';
require_once __DIR__ .'/../models/Deporte.php';
require_once __DIR__ .'/../models/Equipo.php';
require_once __DIR__ .'/../lib/Control.php';

class EquiposController extends Control{

    public $title;
    public $view;
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
        $this->load_view('equipos/detalles', ['equipo' => $equipo]);
    }

    public function anadir(){
        $deporteObj = new Deporte();
        $deportes = $deporteObj->getDeportes();
        $this->load_view('equipos/anadir', ['deportes' => $deportes]);
    }
}
