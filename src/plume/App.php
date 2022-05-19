<?php

namespace Plume;

use Plume\Kernel\Config\Config;
use Plume\Kernel\Debug\ErrorHandler;

defined('PLUME') || die;

/**
 * @package Plume Kernel
 */
class App
{
    const _name = 'Plume';
    const _version = '0.6 alpha';
    const php_version = 7.3;
    private static $memory;
    /*private*/ static $microtime;

    /** @var Type $var description */
    protected $config;

    public function __construct(int $memory, float $microtime)
    {
        self::$memory = $memory;
        self::$microtime = $microtime;
        
        //iniciando configuracion
        Config::init();

        //Manejador de excepciones
        (new ErrorHandler(env('debug')))->start();
    }

    public function run()
    {
        //tester
        //require ABS_PATH . 'tester/tester.php';

        require ABS_PATH . 'src/routes.php';
    }

    public function install()
    {
        # code...
    }
}
