<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= e($title ?? 'App') ?> - <?= e(\App\Core\Env::get('APP_NAME', 'App')) ?></title>

   <link rel="stylesheet" href="<?= url('/css/carlos.css') ?>">
</head>
<body>
<nav>
    <a href="<?= url('') ?>">Inicio</a>
    <a href="<?= url('clientes') ?>">Clientes</a>
    <a href="<?= url('vehiculos') ?>">Vehiculos</a>
    <a href="<?= url('alquileres') ?>">Alquileres</a>
    <!-- MENU -->
</nav>

<main>
    <?php if ($flash = \App\Core\Flash::pull()): ?>
        <div class="flash <?= e($flash['t']) ?>">
            <?= e($flash['m']) ?>
        </div>
    <?php endif; ?>

    <?= $content ?>
</main>
</body>
</html>
