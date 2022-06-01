<?php

namespace Plume\Controller;

use Plume\Controllers;
use Plume\Kernel\Cookies\Session;
use Plume\Kernel\File\Json;

defined('PLUME') || die;

/**
 * undocumented class
 */
class Dashboard extends Controllers
{
    public function __construct()
    {
        parent::__construct();

        $this->session = new Session([
            'name' => env('session_name')
        ]);

        $this->session->start();
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
    public function index()
    {
        if ($this->session->has('active')) {
            return view(__FUNCTION__, [
                'title' => parent::_name,
                'user' => $this->session->get('user')
            ], true);
        }
        
        if ($_POST) {

            //Model
            $data = Json::get(PATH_CFG.'user');
            if (key_exists($_POST['user'],$data)) {
                
                if (password_verify($_POST['pass'], $data[$_POST['user']]['hash'])) {
                    $this->session->set('active', true);
                    $this->session->set('user', $_POST['user']);
                    return redirect('/admin');
                }
                die('Pass invalid');
            }
            die('User invalid');

        } else {
            return view('login', [
                'title' => parent::_name,
            ], true);
        }
    }

    public function users()
    {
        echo $this->session->get('user');
    }

    public function off()
    {
        $this->session->destroy();
        return redirect('/');
    }
}
