<?php

namespace Plume\Controller;

use Plume\Controllers;

defined('PLUME') || die;

/**
 * undocumented class
 */
class Dashboard extends Controllers
{
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
        return view(__FUNCTION__,[],true);
    }
}
