<div class="d-flex justify-content-between align-items-center">
    <h2>Listado de equipos</h2>
    <button class="btn" onclick="goToPage(event,'<?=BASE_URL?>/anadir')">Añadir equipo</button>
</div>
<section>
<?php foreach ($equipos as $equipo): ?>
    <div class="flex">
        <span>🔵</span>
        <a href="<?= BASE_URL ?>/equipos/mostrar/<?= $equipo->id ?>">
            <?= $equipo->getNombre() ?>
        </a>
    </div>
<?php endforeach; ?>
</section>
