<?php
public function dispatch()
{
    foreach ($this->rutes as $method => $rutes) {

        if ($this->request->getMethod() === $method) {
            foreach ($rutes as $rute => $action) {


                //parsear path
                $path = preg_replace(array_keys($this->regex), array_values($this->regex),  preg_replace('/{.*}/', '', $rute));



                    //establecer path de la reques target
                    
                    $uri = new Uri('http://localhost/plume');
                    $request = str_replace($uri->getPath(), '', $this->request->getRequestTarget());

                    //buscar coinsidencias de rutas
                    if (preg_match("~^/?$path/?$~", $request)) {

                        //definir parametros
                        $params = array_filter(explode('/', $request));
                        foreach (explode('/', $rute) as $key => $value) {
                            /*$array = explode('/', str_ireplace(env('path'), '', $this->request->getRequestTarget()));
                            if (substr($value, strlen($value) - 1) == '}') {
                                $param[] = $array[$key];
                            }*/

                            //echo "$key = ".substr($value, strlen($value))."<br>";
                        }
                        //var_dump(explode('/', preg_replace('/^(.*)/', '',$rute)));





                        
                        //callback function
                        if (is_object($action)) {
                            $fun = new ReflectionFunction($action);


                            if (empty($fun->getParameters())) {
                                return $action();
                            }

                            //if (count($param) === $reflection->getNumberOfRequiredParameters()) {
                            return call_user_func_array($action, $params);
                            //}
                        }

                        //calback object
                        if (is_array($action)) {
                            return $this->obj($action[0], $action[1], $params);
                        }



                        
                    }

                    
                }
            }
        }
        //throw new Exception("Error Processing Request", 404);
        //die('Error 404');
    }