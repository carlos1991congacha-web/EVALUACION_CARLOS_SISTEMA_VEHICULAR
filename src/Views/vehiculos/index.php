<div class="toolbar">
    <h1>Vehiculos</h1>
    <a class="btn" href="<?= url('vehiculos/create') ?>">Nuevo</a>
</div>

<?php if (empty($items)): ?>
    <p>No hay registros.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
            <th>Vehiculo id</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Anio</th>
            <th>Disponible</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
            <td><?= e($item->vehiculo_id) ?></td>
            <td><?= e($item->marca) ?></td>
            <td><?= e($item->modelo) ?></td>
            <td><?= e($item->anio) ?></td>
            <td><?= $item->disponible === null ? '-' : ($item->disponible ? 'Si' : 'No') ?></td>
                <td class="actions">
                    <a href="<?= url('vehiculos/edit/' . $item->vehiculo_id) ?>">Editar</a>

                    <form method="post"
                          action="<?= url('vehiculos/delete/' . $item->vehiculo_id) ?>"
                          onsubmit="return confirm('Eliminar este registro?')">
                        <button class="link danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
