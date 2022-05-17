<?php

use Plume\Kernel\Router\Rute;

$rute = new Rute;

/*$rute->get('/', function()
{
    echo 'Welcome back';
});*/

$rute->group('/admin', function() use ($rute)
{
    $rute->get('/',[]);
    $rute->get('/',[]);
    $rute->get('/',[]);
});

$rute->routing();