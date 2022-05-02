<?php
namespace Tester;
class MyController{
    public function __construct()
    {
        //code
    }

    public function index()
    {
        echo <<<HTML
        <h1>Sea bienvenido</h1>
        HTML
    }
    public function name($name = 'Plume')
    {
        echo 'Clase <b>'. __CLASS__;
    }
}