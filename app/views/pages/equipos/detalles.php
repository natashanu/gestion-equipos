<?php
require_once __DIR__."/../../../helpers/date.php";
?>
<a href="<?= BASE_URL?>/equipos" 
    class="text-decoration-none" style="font-size: 18px">←</a>
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
    <div>
        <span class="fw-bold">Capitán: </span>
        <span><?= $equipo->getCapitan()?->getNombre() ?? '-' ?></span>
    </div>
    <div class="my-2">
        <div class="d-flex justify-content-between">
            <h3>Jugadores</h3>
            <button class="btn" onclick="goToPage(event,'<?=BASE_URL?>/jugadores/formulario/<?=$equipo->getId()?>')">Añadir</button>
        </div>
        <?php if(count($jugadores)>0): ?>
        <table class="w-100 my-2">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Número</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($jugadores as $jugador):?>
                    <tr>
                        <td><?= $jugador->getNombre()?></td>
                        <td><?=$jugador->getNumero()?></td>
                        <td>
                            <button class="btn" onclick="goToPage(event,'<?=BASE_URL?>/jugadores/formulario/<?=$equipo->getId() ?? ''?>/<?= $jugador->getId()??''?>')">📝</button>
                            <button class="btn">🗑️</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else:?>
            <p>No se han añadido jugadores al equipo.</p>
        <?php endif;?>
    </div>
    <?php endif; ?>
</section>


