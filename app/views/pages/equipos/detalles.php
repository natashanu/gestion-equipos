<?php
require_once __DIR__."/../../../helpers/date.php";
?>
<h2>Detalles de equipo</h2>
<section>
    <?php if($equipo): ?>
    <div>
        <span>Nombre:</span>
        <span><?= $equipo->getNombre() ?></span>
    </div>
    <div>
        <span>Ciudad: </span>
        <span><?= $equipo->getCiudad()?></span>
    </div>
    <div>
        <span>Deporte: </span>
        <span><?= $equipo->getDeporte()?></span>
    </div>
    <div>
        <span>Fecha fundación: </span>
        <span><?= fechaMysqlAEsp($equipo->getFechaFundacion())?></span>
    </div>
    <?php endif; ?>
</section>


