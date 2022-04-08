<?php

/**
 * @package Plume
 */

use Plume\Kernel\App;
use Plume\Kernel\Router\Rute;

$memory_start = memory_get_usage();
$time = microtime(true);

define('PLUME', true);

//Constantes iniciales
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('ABS_PATH') || define('ABS_PATH', __DIR__ . DS);

//Autoloader function
require_once 'src/bootstrap/app.php';

$app = new App;

//$app->run();

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

$rute = new Rute;

$rute->get('/',function() use ($app)
{
    echo "Hola bienvenido a ".$app::$name;
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

$rute->routing();


echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

echo "<br> <b> " . round((memory_get_usage() - $memory_start) / (1024 * 1024), 4) . "MB";

echo "<br>" . round((microtime(true) - $time) * 1000, 4) . "ms";