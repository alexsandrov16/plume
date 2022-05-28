<?php

namespace Plume\Controller;

use Plume\Controllers;
use Plume\Kernel\Cookies\Session;

defined('PLUME') || die;

/**
 * undocumented class
 */
class Dashboard extends Controllers
{
    public function __construct()
    {
        parent::__construct();

        $this->session = new Session();

        $this->session->start();
        $this->session->set('user', 'admin');
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
        if ($this->session->has('user')) {
            return view(__FUNCTION__, [
                'title' => parent::_name,
                'user' => $this->session->get('user')
            ], true);
        }
        return view('login', [
            'title' => parent::_name,
        ], true);
    }

    public function users()
    {
        echo $this->session->get('user');
    }

    public function off()
    {
        $this->session->destroy();
    }
}
