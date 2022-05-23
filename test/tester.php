<?php

use Plume\Kernel\Router\Rute;
use Tester\MyController;

$rute = new Rute;

/*$rute->get('/', function()
{
    echo 'Welcome back';
});*/

$rute->get('/', [MyController::class, 'index']);

$rute->get('/bug', function()
{
    include 'index.html';
});

$rute->routing();