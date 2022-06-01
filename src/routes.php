<?php

use Plume\Kernel\Cookies\Session;
use Plume\Kernel\Router\Rute;

$rute = new Rute;

$rute->get('/', function () {
    /*$content = '01.home';
    $file = PATH_PAGES . "$content/index.txt";
    echo file_get_contents($file);*/
    return view('index', [
        'title' => env('title') . ' - Home',
        'message' => 'Bienvenidos a ' . env('title')
    ]);
});

$rute->group('/admin', function ($rute) {
    $rute->map(['get','post'],'/', [Plume\Controller\Dashboard::class]);
    $rute->get('/off',['Plume\Controller\Dashboard', 'off']);
    
    /*
    $rute->get('/', [Plume\Controller\Dashboard::class]);
    $rute->post('/', function () {
        if ($_POST) {
            return var_dump($_POST);
        }
    });

    $rute->get('/user', [Plume\Controller\Dashboard::class, 'users']);
    $rute->get('/off', [Plume\Controller\Dashboard::class, 'off']);*/
});

$rute->get('/(:any)', function () {
    //echo 'Pagina cualkiera';
    return view('index', [
        'title' => env('title') . ' - Another Pages',
        'message' => '🙄<br>Esta es otra pagina'
    ]);
});

$rute->routing();