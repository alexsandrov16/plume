<?php

use Plume\Kernel\Cookies\Session;
use Plume\Kernel\Router\Rute;

$rute = new Rute;

$rute->get('/', function () {
    $content = '01.home';
    $file = PATH_PAGES . "$content/index.txt";
    echo file_get_contents($file);
});

$rute->group('/admin', function ($rute) {
        $rute->get('/', [Plume\Controller\Dashboard::class]);

        $rute->get('/user', [Plume\Controller\Dashboard::class, 'users']);
        $rute->get('/off', [Plume\Controller\Dashboard::class, 'off']);
});

$rute->get('/(:any)', function () {
    echo 'Pagina cualkiera';
});

$rute->routing();
