<?php

use Plume\Kernel\Router\Rute;

$rute = new Rute;

$rute->get('/', function(){
    $content = '01-home';
    echo file_get_contents(PATH_CFG."pages/$content/index.txt");
});


$rute->routing();
