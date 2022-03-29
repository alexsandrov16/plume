<?php
defined('PLUME') || die;

/**
 * @package
 */

//Defines
require_once 'define.php';

//Autoloader PSR4
require_once 'autoload.php';

//Functions 
require_once 'functions.php';

//Installing CMS
if (file_exists(ABS_PATH.'installphp')) {
    require 'install.php';
}