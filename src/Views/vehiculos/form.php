<h1><?= e($title) ?></h1>

<form method="post" action="<?= url($action) ?>">
    <div class="field">
        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" maxlength="100" value="<?= e($entity->marca) ?>" required>
        <?php if (isset($errors['marca'])): ?>
            <small class="error"><?= e($errors['marca']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" maxlength="100" value="<?= e($entity->modelo) ?>" required>
        <?php if (isset($errors['modelo'])): ?>
            <small class="error"><?= e($errors['modelo']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="anio">Anio</label>
        <input type="number" id="anio" name="anio" step="1" value="<?= e($entity->anio) ?>">
        <?php if (isset($errors['anio'])): ?>
            <small class="error"><?= e($errors['anio']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="disponible">Disponible</label>
        <input type="checkbox" id="disponible" name="disponible" value="1" <?= $entity->disponible ? 'checked' : '' ?>>
        <?php if (isset($errors['disponible'])): ?>
            <small class="error"><?= e($errors['disponible']) ?></small>
        <?php endif; ?>
    </div>

    <div class="buttons">
        <button class="btn" type="submit">Guardar</button>
        <a href="<?= url('vehiculos') ?>">Cancelar</a>
    </div>
</form>
