<?php

namespace Plume\Kernel\Router;

defined('PLUME') || die;


/**
 * Manejo de rutas
 */
class Rute
{
    /** @var array $rutes matriz de todas las rutas y sus asignaciones. */
    private $rutes = [];

    /**
     * Añadir ruta
     *
     * Undocumented function long description
     *
     * @param string|array $method metodo HTTP
     * @param string $rute ruta
     * @param array|object $action accion al resolver la ruta
     * @param array $options cabecera HTTP
     * @return type
     * @throws conditon
     **/
    private function add($method, string $rute, $action, array $options)
    {
        if (key_exists($rute, $this->getAll())) {
            die('error ya existe esa ruta');
        }
        $this->rutes[$rute] = [
            'method' => $method,
            'action' => $action,
            'opstions' => $options
        ];
    }

    /**
     * Añadir ruta con metodo GET
     *
     * Undocumented function long description
     *
     * @param string $rute ruta
     * @param array|object $action accion al resolver la ruta
     * @param array $options cabecera HTTP
     * @return type
     **/
    public function get(string $rute, $action, array $options = [])
    {
        $this->add('GET', $rute, $action, $options);
    }

    /**
     * Añadir ruta con metodo POST
     *
     * Undocumented function long description
     *
     * @param string $rute ruta
     * @param array|object $action accion al resolver la ruta
     * @param array $options cabecera HTTP
     * @return type
     **/
    public function post(string $rute, $action, array $options = [])
    {
        $this->add('POST', $rute, $action, $options);
    }

    /**
     * Añadir ruta con diferentes metodos HTTP
     *
     * Undocumented function long description
     *
     * @param array $method metodos HTTP
     * @param string $rute ruta
     * @param array|object $action accion al resolver la ruta
     * @param array $options cabecera HTTP
     * @return type
     **/
    public function map(array $methods, string $rute, $action, array $options = [])
    {
        //Pasar a mayuscula los metodos
        $methods = array_map('strtoupper',$methods);
        $this->add($methods, $rute, $action, $options);
    }

    /**
     * Añadir ruta con cualquier metodo HTTP
     *
     * Undocumented function long description
     *
     * @param string $method metodo HTTP
     * @param string $rute ruta
     * @param array|object $action accion al resolver la ruta
     * @param array $options cabecera HTTP
     * @return type
     **/
    public function any(string $rute, $action, array $options = [])
    {
        $this->add('*', $rute, $action, $options);
    }

    /**
     * Mostrar todas las rutas
     *
     * Undocumented function long description
     *
     * @return array
     **/
    public function getAll():array
    {
        return $this->rutes;
    }

    /**
     * Añadir todas las rutas
     *
     * Undocumented function long description
     *
     * @param array $rutes array de 
     * @return type
     **/
    public function setAll(array $rutes)
    {
        $this->rutes = $rutes;
    }

    /**
     * Chequear todas las rutas
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function routing()
    {
        return new Dispatcher($this->getAll());
    }
}
