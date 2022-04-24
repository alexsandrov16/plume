<?php

namespace Plume\Kernel\Router;

use Plume\Kernel\Http\Request;
use Plume\Kernel\Http\Uri;
use ReflectionFunction;

defined('PLUME') || die;

/**
 * Disparador de rutas
 */
class Dispatcher
{
    /** @var array $regex marcadores de posición */
    private $regex = [
        '(:any)'      => '[^/]+',         //cualquier caracter excepto /
        '(:alphanum)' => '[a-zA-Z0-9]+',  //caracteres alfanumericos
        '(:num)'      => '[0-9]+',        //caracteres numericos
        '(:alpha)'    => '[a-zA-Z]+',     //caracteres alfabeticos

    ];

    /** @var object $request Request::class */
    protected $request;

    /**
     * Constructor
     *
     * @param array $rute rutas registradas
     * @return object
     * @throws conditon
     **/
    public function __construct(array $rutes)
    {
        $this->request = new Request;

        //Chequear rutas
        foreach ($rutes as $rute => $value) {

            //Comparar rutas
            if (preg_match('#^' . $this->placeholder($rute) . '$#', $this->request(), $match)) {

                //validar metodo
                if ($this->validateMethod($value['method'])) {

                    return $this->callActions($value['action'], $this->parameters($match));
                }
            }
        }
        //throw new Exception("Error Processing Request", 404);
        
    }

    /**
     * Marcador de posicion
     *
     * Cambia los marcadores de posición por patrón de expresión regular en la URI
     *
     * @param string $rute Description
     * @return string
     **/
    private function placeholder(string $rute)
    {
        return preg_replace(array_keys($this->regex), array_values($this->regex), $rute);
    }

    /**
     * Validar metodo HTTP
     *
     * Verifica que el metodo HTTP de la solicitud coincida con el metodo
     * epsecificado en la ruta
     *
     * @param array|string $method metodo HTTP
     * @return bool
     **/
    private function validateMethod($method)
    {
        if (is_array($method) && in_array($this->request->getMethod(), $method)) {
            return true;
        }

        if ($this->request->getMethod() == $method) {
            return true;
        }

        return false;
    }

    /**
     * Callback
     *
     * Realiza una devoluciones de llamada/controladores de ruta inyectan los
     * metodos y parametros correspondientes
     *
     * @param object|array $actions func anonima| controlador-metodo a ser invocado
     * @param array $params parametros
     * @return object
     * @throws conditon
     **/
    private function callActions($actions, $params)
    {
        if (is_object($actions)) {
            $reflaction = new ReflectionFunction($actions);


            if (empty($reflaction->getParameters())) {
                return $actions();
            }

            return call_user_func_array($actions, $params);
        }

        if (is_array($actions)) {
            if (class_exists($actions[0])) {
                $instance = new $actions[0];
                $method = $actions[1];

                if (empty($method)) {
                    return $instance->index();
                }

                if (method_exists($instance, $method)) {
                    $reflaction = new \ReflectionMethod($instance, $method);

                    if ($reflaction->isPublic()) {

                        if (empty($reflaction->getParameters())) {
                            return $instance->$method();
                        }

                        return call_user_func_array(array($instance, $method), $params);
                    }
                    //throw new Exception("Method not public $controller::$method");
                }
                //throw new Exception("Not Found Method $controller::$method");
            }
            //throw new Exception("Not Found Controller $controller");
        }
    }

    /**
     * Obtener parametros
     *
     * Devuelve las coincidencias obtenidas de los  marcadores de posición 
     * como parámetros de ruta
     *
     * @param array $matchs coincidencias obtenidas
     * @return array
     **/
    private function parameters(array $matchs)
    {
        $params = [];
        foreach ($matchs as $key => $value) {
            if ($key % 2 != 0) {
                $params[] = $value;
            }
        }

        return $params;
    }

    /**
     * Destino de la solicitud 
     *
     * Establece el segmento de URI del destino de la solicitud 
     *
     * @return string
     **/
    private function request()
    {
        //agregar base_uri
        $uri = new Uri(env('base_url'));
        return str_replace($uri->getPath(), '', $this->request->getRequestTarget());
    }
}
