<h1><?= e($title) ?></h1>

<form method="post" action="<?= url($action) ?>">
    <div class="field">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" maxlength="100" value="<?= e($entity->nombre) ?>" required>
        <?php if (isset($errors['nombre'])): ?>
            <small class="error"><?= e($errors['nombre']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" maxlength="100" value="<?= e($entity->apellido) ?>" required>
        <?php if (isset($errors['apellido'])): ?>
            <small class="error"><?= e($errors['apellido']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="licencia">Licencia</label>
        <input type="text" id="licencia" name="licencia" maxlength="50" value="<?= e($entity->licencia) ?>" required>
        <?php if (isset($errors['licencia'])): ?>
            <small class="error"><?= e($errors['licencia']) ?></small>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="telefono">Telefono</label>
        <input type="text" id="telefono" name="telefono" maxlength="20" value="<?= e($entity->telefono) ?>">
        <?php if (isset($errors['telefono'])): ?>
            <small class="error"><?= e($errors['telefono']) ?></small>
        <?php endif; ?>
    </div>

    <div class="buttons">
        <button class="btn" type="submit">Guardar</button>
        <a href="<?= url('clientes') ?>">Cancelar</a>
    </div>
</form>
