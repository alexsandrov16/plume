<?php

use Plume\Kernel\Router\Rute;
/**** ROUTER ***/
/*
$rute = [
    '/' => [
        'method' => 'get',
        'action' => function(){echo 'hola';},
        'headers' => ['content type'=> 'text/html']
    ],
    '/home' => [
        'method' => ['get','post'],
        'action' => function(){echo 'hola';},
        'headers' => ['content type'=> 'text/html']
    ],
    '/about' => [
        'method' => '*',
        'action' => function(){echo 'hola';},
        'headers' => ['content type'=> 'text/html']
    ]
];*/


//var_dump($rute);
/*
$rutes = new Rute;
$rutes->setRutes($rute);

$router = new Router;

$router->dispatch($rutes->getRutes());
*/

class MyController{
    public function __construct()
    {
        
    }

    public function index()
    {
        echo <<<HTML
        <h1>Sea bienvenido</h1>
        HTML;
    }
    public function name($name = 'Plume')
    {
        echo 'Clase <b>'. __CLASS__;
    }
}

$rute = new Rute;

$rute->get('/',function() use ($app)
{
    echo "Hola <u>bienvenido</u> a ".$app::$name;
});

$rute->get('/hola/(:any)',function($name)
{
    echo "Hola $name!";
});

$rute->map(['get','post'], '/form', function()
{
    if ($_POST) {
        echo 'Hola soy un dato con valor '.$_POST['data'];return;
    }

    echo <<<HTML
    <form action="" method="post">
    <input type="text" name="data" id="">
    <button type="submit">enviar</button>
    </form>
    HTML;
});

$rute->get('/home',[MyController::class]);
$rute->get('/class',['MyController', 'name']);

$rute->routing();