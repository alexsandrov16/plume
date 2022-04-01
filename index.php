<?php

/**
 * @package Plume
 */

use Plume\Kernel\App;
use Plume\Kernel\Http\Request;
use Plume\Kernel\Http\Response;
use Plume\Kernel\Routing\Router;

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
class Myclass{
    public function index()
    {
        echo 'Hola mundo';
    }
}

$request = new Request;
$response = new Response;


$router = new Router($request, $response);
/*
$router->add('get', '/(:alpha)/sal/(:num)', function($name)// use ($app)
{
    echo "Hola $name";//.$app::$name;
});

/*
$router->add('/', function()
{
    echo 'Hola Mundo!';
}, 'get');

$router->add('/{var}', function($var)
{
    echo 'Hola Mundo!';
}, 'get');

$router->add('/{var}/algo/{var2}(:num)', function($var, $var2)
{
    echo 'Hola Mundo!';
}, 'get');
*/

$router->add('get', '/(:any)', [Myclass::class, 'index']);

$router->dispatch();


echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

echo "<br> <b> ".round((memory_get_usage() - $memory_start)/(1024*1024),4). "MB";

echo "<br>". round((microtime(true) - $time)*1000,4)."ms";