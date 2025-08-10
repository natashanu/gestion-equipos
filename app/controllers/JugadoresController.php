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
            $id_jugador = $this->jugadorObj->create();

            if (isset($_POST['es_capitan']) && $id_jugador) {
                $capitan = (new Jugador())->getJugadorPorId($id_jugador);
                if ($capitan !== null) {
                    $equipo->setCapitan($capitan);
                    $equipo->update();
                }
            }

            header("Location: " . BASE_URL . "/equipos/mostrar/". $_POST['id_equipo']);
            exit;
        } else {
            $errores = getErrores();
            
            $this->load_view('jugadores/formulario', ['equipo' => $equipo, 'jugador' => $this->jugadorObj]);
        }
    }

    public function actualizar(){
        $reglas = [
            'nombre' => ['required','string', 'max:255'],  
            'numero' => ['required', 'number'],
        ];

        if (validarCampos($_POST, $reglas)) {
            $equipo = (new Equipo)->getEquipoPorId($_POST['id_equipo']);

            $this->jugadorObj->setId($_POST['id_jugador'] ?? null);
            $this->jugadorObj->setNombre($_POST['nombre'] ?? null);
            $this->jugadorObj->setNumero($_POST['numero'] ?? null);
            $this->jugadorObj->update();

            $esCapitanFormulario = isset($_POST['es_capitan']) && $_POST['es_capitan'] == '1';
            $capitanActual = $equipo->getCapitan();

            // Si el jugador es el capitán actual pero en el formulario no está marcado, se desmarca
            if ($capitanActual && $capitanActual->getId() === $this->jugadorObj->getId() && !$esCapitanFormulario) {
                $equipo->setCapitan(null);
                $equipo->update();
            }

            // Si en el formulario está marcado como capitán y no lo es ya, se asigna
            if ($esCapitanFormulario && (!$capitanActual || $capitanActual->getId() !== $this->jugadorObj->getId())) {
                $equipo->setCapitan($this->jugadorObj);
                $equipo->update();
            }

            header("Location: " . BASE_URL . "/equipos/mostrar/". $_POST['id_equipo']);
            exit;
        } else {
            $errores = getErrores();
            
            $this->load_view('jugadores/formulario', ['equipo' => $equipo, 'jugador' => $this->jugadorObj]);
        }

    }

    public function eliminar(){

    }

}