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
require_once 'src/autoload.php';

require_once 'src/define.php';
require_once 'src/function.php';

$app = new App;

return $app;