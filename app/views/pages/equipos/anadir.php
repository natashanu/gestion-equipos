<h2>Añadir equipo</h2>
<section>
    <form action="<?= BASE_URL ?>/equipos/guardar" method="POST">
        <label for="nombre">
            <span>Nombre</span>
            <input type="text" name="nombre" id="nombre">
            <?php if (!empty($errores['nombre'])): ?>
                <span class="error"><?= $errores['nombre'] ?></span>
            <?php endif; ?>
        </label>
        <label>
            <span>Deporte</span>
            <select name="deporte" id="deporte">
                <option selected value="">-- Seleccionar --</option>
                <?php foreach ($deportes as $deporte): ?>
                    <option value="<?= $deporte['id'] ?>">
                        <?= $deporte['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errores['deporte'])): ?>
                <span class="error"><?= $errores['deporte'] ?></span>
            <?php endif; ?>
        </label>
        <label>
            <span>Ciudad</span>
            <select name="ciudad" id="ciudad">
                <option selected value="">-- Seleccionar --</option>
                <?php foreach ($ciudades as $ciudad): ?>
                    <option value="<?= $ciudad['id'] ?>">
                        <?= $ciudad['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errores['ciudad'])): ?>
                <span class="error"><?= $errores['ciudad'] ?></span>
            <?php endif; ?>
        </label>
        <label for="fecha_fundacion">
            <span>Fecha fundación</span>
            <input type="date" name="fecha_fundacion" id="fecha_fundacion">
            <?php if (!empty($errores['fecha_fundacion'])): ?>
                <span class="error"><?= $errores['fecha_fundacion'] ?></span>
            <?php endif; ?>
        </label>
        <div></div>
        <div>
            <button class="btn btn-secondary" onclick="goToPage(event, '<?= BASE_URL ?>/equipos')">Cancelar</button>
            <button class="btn" type="submit">Guardar</button>
        </div>
    </form>
</section>
<script>
    document.querySelector("form").addEventListener("submit", function(e) {
        e.preventDefault();
        let errores = [];

        const nombre = document.getElementById("nombre").value.trim();
        const deporte = document.getElementById("deporte").value;
        const ciudad = document.getElementById("ciudad").value;
        const fecha = document.getElementById("fecha_fundacion").value;

        if (nombre.length <= 0 || nombre.length > 255) {
            errores.push("El nombre debe tener máximo 255 caracteres.");
        }
        if (deporte === "") {
            errores.push("Debes seleccionar un deporte.");
        }
        if (ciudad === "") {
            errores.push("Debes seleccionar una ciudad.");
        }
        if (!fecha) {
            errores.push("Selecciona una fecha.");
        }

        if (errores.length > 0) {
            alert(errores.join("\n"));
            return;
        }

        this.submit();
    });
</script>