<?php

use Plume\Kernel\Router\Rute;

$rute = new Rute;

$rute->get('/', function()
{
    echo 'Welcome back';
});

$rute->get('/bug', function()
{
    include 'index.html';
});

$rute->routing();