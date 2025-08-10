<?php
require_once __DIR__."/../../../helpers/date.php";
?>
<h2>Detalles del equipo</h2>
<section>
    <?php if($equipo): ?>
    <div>
        <span class="fw-bold">Nombre:</span>
        <span><?= $equipo->getNombre() ?></span>
    </div>
    <div>
        <span class="fw-bold">Ciudad: </span>
        <span><?= $equipo->getCiudad()?></span>
    </div>
    <div>
        <span class="fw-bold">Deporte: </span>
        <span><?= $equipo->getDeporte()?></span>
    </div>
    <div>
        <span class="fw-bold">Fecha fundación: </span>
        <span><?= fechaMysqlAEsp($equipo->getFechaFundacion())?></span>
    </div>
    <?php endif; ?>
</section>


