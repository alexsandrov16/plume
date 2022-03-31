<?php

/**
 * @package Plume
 */

use Plume\Kernel\App;
use Plume\Kernel\Http\Request;
use Plume\Kernel\Http\Response;
use Plume\Kernel\Routing\Router;

define('PLUME', true);

//Constantes iniciales
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('ABS_PATH') || define('ABS_PATH', __DIR__ . DS);

//Autoloader function
require_once 'src/bootstrap/app.php';

$app = new App;

//$app->run();*/

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

$router->add('get', '/{name}', function($name)// use ($app)
{
    echo "Hola $name";//.$app::$name;
});

//$router->add('get', '/(:any)', [Myclass::class, 'index']);

$router->dispatch();