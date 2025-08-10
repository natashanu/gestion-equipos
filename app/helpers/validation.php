<?php
$errores = [];

function validarCampos($datos, $reglas) {
    global $errores;

    foreach ($reglas as $campo => $listaReglas) {
        $valor = isset($datos[$campo]) ? trim($datos[$campo]) : null;

        foreach ($listaReglas as $regla) {

            if (strpos($regla, ':') !== false) {
                list($nombreRegla, $param) = explode(':', $regla, 2);
            } else {
                $nombreRegla = $regla;
                $param = null;
            }

            switch ($nombreRegla) {
                case 'required':
                    if ($valor === null || $valor === '') {
                        $errores[$campo] = "Este campo es obligatorio.";
                    }
                    break;

                case 'string':
                    if (!is_string($valor)) {
                        $errores[$campo] = "Este campo debe ser texto.";
                    }
                    break;

                case 'max':
                    if (strlen($valor) > (int)$param) {
                        $errores[$campo] = "Este campo no debe superar $param caracteres.";
                    }
                    break;

                case 'min':
                    if (strlen($valor) < (int)$param) {
                        $errores[$campo] = "Este campo debe tener al menos $param caracteres.";
                    }
                    break;

                case 'email':
                    if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
                        $errores[$campo] = "El campo $campo no es un email válido.";
                    }
                    break;

                case 'date':
                    $formato = $param ?: 'Y-m-d';
                    $fecha = DateTime::createFromFormat($formato, $valor);
                    if (!$fecha || $fecha->format($formato) !== $valor) {
                        $errores[$campo] = "El campo $campo debe ser una fecha válida con formato $formato.";
                    }
                    break;
            }

            if (isset($errores[$campo])) {
                break;
            }
        }
    }

    return empty($errores);
}

function getErrores() {
    global $errores;
    return $errores;
}

function hayErrores() {
    global $errores;
    return !empty($errores);
}
