<?php

namespace Plume\Kernel\Routing;

use Plume\Kernel\Http\Request;
use Plume\Kernel\Http\Response;
use Plume\Kernel\Http\Uri;
use ReflectionFunction;

defined('PLUME') || die;
/**
 * undocumented class
 */
class Router
{
    protected $request;
    protected $response;
    protected $rutes = [];
    protected $regex = [
        '(:any)'      => '.*',
        //'(:segment)'  => '[^/]+',
        '(:alphanum)' => '[a-zA-Z0-9]+',
        '(:num)'      => '[0-9]+',
        '(:alpha)'    => '[a-zA-Z]+',
        //'(:hash)'     => '[^/]+',
    ];

    public $namespace = [];

    /**
     * 
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * 
     */
    public function add(String $method, String $route, $action, array $headers = [])
    {
        foreach ($headers as $name => $value) {
            $this->response->setHeader($name, $value);
        }
        $this->rutes[strtoupper($method)][$route] = $action;
    }

    /**
     * 
     */
    public function get(String $route, $action, array $headers = [])
    {
        return $this->add('GET', $route, $action, $headers);
    }

    /**
     * 
     */
    public function post(String $route, $action, array $headers = [])
    {
        return $this->add('POST', $route, $action, $headers);
    }

    /**
     * 
     */
    public function dispatch()
    {
        foreach ($this->rutes as $method => $rutes) {
            if ($method === $this->request->getMethod()) {
                foreach ($rutes as $rute => $action) {

                    // Ruta registrada
                    $path = preg_replace(array_keys($this->regex), array_values($this->regex), str_replace(['{', '}'], '', $rute));


                    // Establecer path de la reques target
                    $uri = new Uri('http://localhost/plume');
                    $request = str_replace($uri->getPath(), '', $this->request->getRequestTarget());

                    // Comparar rutas
                    if (preg_match('~^/?' . $path . '/?$~', $request)) {

                        return $this->callback($action, $this->params($request, $rute));
                    }
                }
            }
        }

        die(404);
    }

    public function params($request, $rute)
    {
        $arr = explode('/', $request);
        foreach (explode('/', $rute) as $key => $value) {
            if (!preg_match('/[(]/', $value)) {
                unset($arr[$key]);
            }
        }
        return $arr;
    }

    public function callback($callback, $params)
    {
        //callback function
        if (is_object($callback)) {
            return $this->callFunction($callback, $params);
        }

        //calback object
        if (is_array($callback)) {
            return $this->callObject($callback[0], $callback[1], $params);
        }
        die('Not found');
    }

    public function callFunction($function, $params)
    {
        $reflaction = new ReflectionFunction($function);


        if (empty($reflaction->getParameters())) {
            return $function();
        }

        return call_user_func_array($function, $params);
    }

    public function callObject($class, $method = null, $params)
    {
        if (class_exists($class)) {
            $instance = new $class;

            if (!empty($method)) {
                return $instance->index();
            }

            if (method_exists($instance, $method)) {
                $reflaction = new \ReflectionMethod($instance, $method);

                //var_dump($r_method);

                if ($reflaction->isPublic()) {

                    if (empty($reflaction->getParameters())) {
                        return $instance->$method();
                    }

                    //return call_user_func_array(array($instance, $callback[1]), $params);
                }
            }
            //throw new Exception("Not Found Method $controller::$method");
        }
    }













    public function obj($class, $method, $param = [])
    {
        if (class_exists($class)) {
            $obj = new $class;

            if (method_exists($obj, $method)) {
                $reflection = new \ReflectionMethod($obj, $method);

                if ($reflection->isPublic()) {

                    if (empty($reflection->getParameters())) {
                        return $obj->$method();
                    }

                    //if (count($param) === $reflection->getNumberOfRequiredParameters()) {
                    return call_user_func_array(array($obj, $method), $param);
                    //} 
                }
            }
            //throw new Exception("Not Found Method $controller::$method");
            die('Not found method');
        }
    }

    /**
     * 
     */
    public function redirect(string $url, int $code = 302)
    {
        # code...
    }
}
