<?php if($jugador):?>
    <h2>Editar jugador</h2>
<?php else: ?>
    <h2>Añadir jugador</h2>
<?php endif; ?>
<section>
    <form action="<?= $jugador?->getId()? BASE_URL . '/jugadores/actualizar' : BASE_URL . '/jugadores/guardar' ?>" method="POST">
        <?php if ($jugador): ?>
            <input type="hidden" name="id_jugador" value="<?= $jugador?->getId() ?>">
        <?php endif; ?>
        <input type="hidden" name="id_equipo" value="<?= $equipo?->getId() ?>">
        <label>
            <span>Nombre:</span>
            <input type="text" id="nombre" name="nombre" value="<?= $jugador?->getNombre() ?? '' ?>">
            <?php if (!empty($errores['nombre'])): ?>
                <span class="error"><?= $errores['nombre'] ?></span>
            <?php endif; ?>
        </label>
        <label>
            <span>Número:</span>
            <input type="text" id="numero" name="numero" value="<?= $jugador?->getNumero() ?? '' ?>">
            <?php if (!empty($errores['numero'])): ?>
                <span class="error"><?= $errores['numero'] ?></span>
            <?php endif; ?>
        </label>
        <label>
            <span>Equipo:</span>
            <input type="text" id="equipo" name="equipo" value="<?= $equipo?->getNombre() ?? '' ?>" disabled>
        </label>
        <label class="flex-row align-items-center gap-2">
            <input type="checkbox" id="es_capitan" name="es_capitan" 
            value="1"  <?= $jugador && $equipo && $jugador->getId() === $equipo->getCapitan()?->getId() ? 'checked' : '' ?>></input>
            <span>¿Es capitán?</span>
        </label>
        <div></div>
        <div>
            <button class="btn btn-secondary" onclick="goToPage(event, '<?= BASE_URL ?>/equipos/mostrar/<?=$equipo?->getId()?>')">Cancelar</button>
            <button class="btn" type="submit">Guardar</button>
        </div>
    </form>
</section>

