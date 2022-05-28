<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | <?= $title ?></title>
    <link rel="stylesheet" href="<?= env('base_url') ?>/themes/pico/css/pico.css">
</head>

<body>
    <nav style="padding:0 1em;">
        <ul>
            <li><strong><?= $title ?></strong></li>
        </ul>
        <ul>
            <li><a href="<?=env('base_url')?>/admin/user">Usuarios</a></li>
            <li><a href="<?=env('base_url')?>/admin/off" role="button">Salir</a></li>
        </ul>
    </nav>
    <div class="container">
    <h1 style="text-align: center;">Hello <?=$user?></h1>
    <h1 style="text-align: center;">Welcome Back to <?= $title ?></h1>
    </div>
</body>

</html>