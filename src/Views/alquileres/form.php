<h1><?= e($title) ?></h1>

<form method="post" action="<?= url($action) ?>">
    <div class="field">
        <label for="cliente_id">Cliente id</label>
        <input type="number" id="cliente_id" name="cliente_id" step="1" value="<?= e($entity->cliente_id) ?>">
        <?php if (isset($errors['cliente_id'])): ?>
            <small class="error"><?= e($errors['cliente_id']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="vehiculo_id">Vehiculo id</label>
        <input type="number" id="vehiculo_id" name="vehiculo_id" step="1" value="<?= e($entity->vehiculo_id) ?>">
        <?php if (isset($errors['vehiculo_id'])): ?>
            <small class="error"><?= e($errors['vehiculo_id']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="fecha_inicio">Fecha inicio</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?= e($entity->fecha_inicio) ?>" required>
        <?php if (isset($errors['fecha_inicio'])): ?>
            <small class="error"><?= e($errors['fecha_inicio']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="fecha_fin">Fecha fin</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="<?= e($entity->fecha_fin) ?>" required>
        <?php if (isset($errors['fecha_fin'])): ?>
            <small class="error"><?= e($errors['fecha_fin']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="costo">Costo</label>
        <input type="number" id="costo" name="costo" step="0.01" value="<?= e($entity->costo) ?>">
        <?php if (isset($errors['costo'])): ?>
            <small class="error"><?= e($errors['costo']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="estado">Estado</label>
        <input type="text" id="estado" name="estado" maxlength="20" value="<?= e($entity->estado) ?>">
        <?php if (isset($errors['estado'])): ?>
            <small class="error"><?= e($errors['estado']) ?></small>
        <?php endif; ?>
    </div>

    <div class="buttons">
        <button class="btn" type="submit">Guardar</button>
        <a href="<?= url('alquileres') ?>">Cancelar</a>
    </div>
</form>
