<?php

namespace Plume;

use Plume\Kernel\Http\Response;

defined('PLUME') || die;

/**
 * undocumented class
 */
class Controllers extends App
{
    public function __construct()
    {
        $this->response = new Response(200);
    }
}
