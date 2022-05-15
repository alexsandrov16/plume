<?php
namespace Tester;

use Plume\Kernel\Controllers;

class MyController extends Controllers{

    public function index()
    {
        echo '<h1>Sea bienvenido</h1>'.date('h:i a');
    }
    public function name($name = 'Plume')
    {
        echo 'Clase <b>'. __CLASS__;
    }
}