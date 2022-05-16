<?php

use Plume\Kernel\Router\Rute;

$rute = new Rute;

$rute->get('/', function()
{
    echo 'Welcome back';
});
$rute->routing();