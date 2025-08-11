<?php

/**
 * Convierte una fecha en formato MySQL (Y-m-d o Y-m-d H:i:s)
 * al formato de fecha español (d/m/Y).
 *
 * @param string|null $fechaMysql Fecha en formato MySQL.
 * @return string|null Fecha en formato español o null si no es válida.
 */
function fechaMysqlAEsp($fechaMysql)
{
    if (!$fechaMysql) return null;
    $formatos = ['Y-m-d', 'Y-m-d H:i:s'];
    foreach ($formatos as $formato) {
        $date = DateTime::createFromFormat($formato, $fechaMysql);
        if ($date) {
            return $date->format('d/m/Y');
        }
    }
    return null;
}
