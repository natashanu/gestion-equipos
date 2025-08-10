<?php
require_once __DIR__ .'/../models/Equipo.php';
require_once __DIR__ .'/../models/Jugador.php';
require_once __DIR__ .'/../lib/Control.php';
require_once __DIR__ .'/../helpers/validation.php';

class JugadoresController extends Control{
    private Jugador $jugadorObj;

    public function __construct() {
        $this->jugadorObj = new Jugador();
    }

    public function formulario($id_equipo, $id_jugador=null) {
        $equipo = (new Equipo())->getEquipoPorId($id_equipo);
        if($id_jugador){
            $jugador = (new Jugador())->getJugadorPorId($id_jugador);
        }else{
            $jugador = null;
        }
        $this->load_view('jugadores/formulario', ['equipo' => $equipo, 'jugador' => $jugador]);
    }

    public function guardar() {
        $reglas = [
            'nombre' => ['required','string', 'max:255'],  
            'numero' => ['required', 'number'],
        ];

        if (validarCampos($_POST, $reglas)) {
            $equipo = (new Equipo)->getEquipoPorId($_POST['id_equipo']);

            $this->jugadorObj->setNombre($_POST['nombre'] ?? NULL);
            $this->jugadorObj->setNumero($_POST['numero'] ?? NULL);
            $this->jugadorObj->setEquipo($equipo ?? NULL);
            $this->jugadorObj->create();

            header("Location: " . BASE_URL . "/equipos/mostrar/". $_POST['id_equipo']);
            exit;
        } else {
            $errores = getErrores();
            
            $this->load_view('jugadores/formulario', ['equipo' => $equipo, 'jugador' => $this->jugadorObj]);
        }
    }

    public function actualizar(){

    }

    public function eliminar(){

    }

}