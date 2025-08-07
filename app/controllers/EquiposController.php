<?php
require_once __DIR__ .'/../models/Equipo.php';
require_once __DIR__ .'/../lib/Control.php';

class EquiposController extends Control{

    public $title;
    public $view;
    private Equipo $equipoObj;

    public function __construct() {
        $this->equipoModel = new Equipo();
    }

    public function index() {
        $equipos = $this->equipoModel->getEquipos();
        $this->load_view('equipos/index', ['equipos' => $equipos]);
    }

    public function mostrar(int $id) {
        $equipo = $this->equipoModel->getEquipoPorId($id);
        $this->load_view('equipos/detalle', ['equipo' => $equipo]);
    }
}
