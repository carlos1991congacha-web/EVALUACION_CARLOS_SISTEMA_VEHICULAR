<div class="toolbar">
    <h1>Alquileres</h1>
    <a class="btn" href="<?= url('alquileres/create') ?>">Nuevo</a>
</div>

<?php if (empty($items)): ?>
    <p>No hay registros.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
            <th>Alquiler id</th>
            <th>Cliente id</th>
            <th>Vehiculo id</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Costo</th>
            <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
            <td><?= e($item->alquiler_id) ?></td>
            <td><?= e($item->cliente_id) ?></td>
            <td><?= e($item->vehiculo_id) ?></td>
            <td><?= e($item->fecha_inicio) ?></td>
            <td><?= e($item->fecha_fin) ?></td>
            <td><?= e($item->costo) ?></td>
            <td><?= e($item->estado) ?></td>
                <td class="actions">
                    <a href="<?= url('alquileres/edit/' . $item->alquiler_id) ?>">Editar</a>

                    <form method="post"
                          action="<?= url('alquileres/delete/' . $item->alquiler_id) ?>"
                          onsubmit="return confirm('Eliminar este registro?')">
                        <button class="link danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
