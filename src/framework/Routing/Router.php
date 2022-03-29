<?php

namespace Plume\Kernel\Routing;

use Plume\Kernel\Http\Request;
use Plume\Kernel\Http\Response;

defined('PLUME') || die;
/**
 * undocumented class
 */
class Router
{
    private $request;
    private $response;
    public $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * 
     */
    public function add(Type $var = null)
    {
        # code...
    }

    /**
     * 
     */
    public function get(Type $var = null)
    {
        # code...
    }

    /**
     * 
     */
    public function post(Type $var = null)
    {
        # code...
    }

    /**
     * 
     */
    public function dispatch(Type $var = null)
    {
        # code...
    }

    /**
     * 
     */
    public function redirect(Type $var = null)
    {
        # code...
    }
}
