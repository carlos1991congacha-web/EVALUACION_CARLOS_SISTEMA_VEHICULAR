<div class="toolbar">
    <h1>Clientes</h1>
    <a class="btn" href="<?= url('clientes/create') ?>">Nuevo</a>
</div>

<?php if (empty($items)): ?>
    <p>No hay registros.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
            <th>Cliente id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Licencia</th>
            <th>Telefono</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
            <td><?= e($item->cliente_id) ?></td>
            <td><?= e($item->nombre) ?></td>
            <td><?= e($item->apellido) ?></td>
            <td><?= e($item->licencia) ?></td>
            <td><?= e($item->telefono) ?></td>
                <td class="actions">
                    <a href="<?= url('clientes/edit/' . $item->cliente_id) ?>">Editar</a>

                    <form method="post"
                          action="<?= url('clientes/delete/' . $item->cliente_id) ?>"
                          onsubmit="return confirm('Eliminar este registro?')">
                        <button class="link danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
