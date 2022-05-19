<?php

use Plume\Kernel\Router\Rute;

$rute = new Rute;

$rute->get('/', function () {
    $content = '01.home';
    $file = PATH_PAGES . "$content/index.txt";
    echo file_get_contents($file);
});

$rute->group('/admin', function($rute)
{
    $rute->get('/', function(){
        echo 'ADMIN DASHBOARD';
    });
    $rute->get('/user', function(){
        echo 'USER DASHBOARD';
    });
});

$rute->get('/(:any)', function(){
    echo 'Pagina cualkiera';
});

$rute->routing();