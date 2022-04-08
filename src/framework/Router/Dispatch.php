<?php

namespace Plume\Kernel\Router;

use Plume\Kernel\Http\Request;
use Plume\Kernel\Http\Uri;
use ReflectionFunction;

defined('PLUME') || die;

/**
 * Disparador de rutas
 */
class Dispatch
{
    /** @var array $regex description */
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
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
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
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    private function placeholder(string $rute)
    {
        return preg_replace(array_keys($this->regex), array_values($this->regex), $rute);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
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
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
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
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
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
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return string
     * @throws conditon
     **/
    private function request()
    {
        $uri = new Uri('http://localhost/plume');
        return str_replace($uri->getPath(), '', $this->request->getRequestTarget());
    }
}
