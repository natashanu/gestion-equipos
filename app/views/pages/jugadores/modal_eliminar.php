<div class="modal fade" id="modal_eliminar" tabindex="-1" aria-labelledby="modal_eliminar_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_eliminar_label">Eliminar jugador</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el jugador <span class="fw-bold" id="nombre_jugador_eliminar"></span>?</p>
                <form id="form_eliminar" method="POST" action="<?= BASE_URL ?>/jugadores/eliminar">
                    <input type="hidden" name="id_jugador" id="id_jugador_eliminar" value="">
                    <input type="hidden" name="id_equipo" value="<?= $equipo->getId() ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger" form="form_eliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>