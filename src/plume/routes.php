<?php

use Plume\Kernel\Router\Rute;

$rute = new Rute;

/*$rute->get('/', function()
{
    echo 'Welcome back';
});*/
$rt = 'dfg';

$rute->group('/admin', function () use ($rute)
{
    $rute->get("/$algo", ['asd']);
});


$rute->routing();
