<?php
defined('PLUME') || die;

/**
 * Botstrap app
 * 
 * Este proceso configura las constantes de ruta, carga nuestro
 * cargador automático, junto con el de Composer, carga nuestras funciones 
 * y activa un arranque específico del entorno.
 * 
 * @package
 */


//Defines
require_once 'define.php';

//Autoloader PSR4
require_once 'autoload.php';

//Functions 
require_once 'functions.php';

//Installing CMS esto ba en el fichero index
if (file_exists(ABS_PATH . 'installphp')) {
    require 'install.php';
}
