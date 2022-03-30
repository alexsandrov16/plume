<?php

namespace Plume\Kernel\Routing;

use Plume\Kernel\Http\Request;
use Plume\Kernel\Http\Response;
use Plume\Kernel\Http\Uri;

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
        '(:segment)'  => '[^/]+',
        '(:alphanum)' => '[a-zA-Z0-9]+',
        '(:num)'      => '[0-9]+',
        '(:alpha)'    => '[a-zA-Z]+',
        '(:hash)'     => '[^/]+',
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

            if ($this->request->getMethod() === $method) {
                foreach ($rutes as $rute => $action) {

                    //parsear path
                    $path = preg_replace(array_keys($this->regex), array_values($this->regex), str_replace(['{', '}'], '', $rute));
                    
                    //establecer path de la reques target
                    $uri = new Uri('http://localhost/plume');
                    $request = str_replace($uri->getPath(), '', $this->request->getRequestTarget());

                    //buscar coinsidencias de rutas
                    if (preg_match("~^/?$path/?$~", $request)) {

                        echo 'yupii';return;

                    }
                }
            }
        }
        //throw new Exception("Error Processing Request", 404);
        die('Error 404');
    }

    /**
     * 
     */
    public function redirect()
    {
        # code...
    }
}
