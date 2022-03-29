<?php

/**
 * @package Plume
 */

use Plume\Kernel\App;

define('PLUME', true);

//Constantes iniciales
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('ABS_PATH') || define('ABS_PATH', __DIR__ . DS);

//Autoloader function
require_once 'src/bootstrap/app.php';

//$app = new App;

echo __FILE__;