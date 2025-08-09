<h2>Añadir equipo</h2>
<section>
    <form>
        <label for="nombre">
            <span>Nombre</span>
            <input type="text" name="nombre" id="nombre">
        </label>
        <label>
            <span>Deporte</span>
            <select name="deporte" id="deporte">
                <option selected>-- Seleccionar --</option>
                <?php foreach($deportes as $deporte):?>
                    <option value="<?=$deporte['id']?>">
                        <?= $deporte['nombre']?>
                    </option>
                <?php endforeach;?>
            </select>
        </label>
        <label>
            <span>Ciudad</span>
            <select name="ciudad" id="ciudad">
                <option selected>-- Seleccionar --</option>
                <?php foreach($deportes as $deporte):?>
                    <option value="<?=$deporte['id']?>">
                        <?= $deporte['nombre']?>
                    </option>
                <?php endforeach;?>
            </select>
        </label>
                <label for="fecha_fundacion">
            <span>Fecha fundación</span>
            <input type="date" name="fecha_fundacion" id="fecha_fundacion">
        </label>
        <button type="submit">Guardar</button>
        <button>Cancelar</button>
    </form>
</section>