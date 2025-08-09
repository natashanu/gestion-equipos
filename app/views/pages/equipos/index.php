<h2>Listado de equipos</h2>
<section>
<?php foreach ($equipos as $equipo): ?>
    <div>
        <a href="<?= BASE_URL ?>/equipos/mostrar/<?= $equipo['id'] ?>">
            <?= ($equipo['nombre']) ?>
        </a>
    </div>
<?php endforeach; ?>
</section>
