<?php
defined('PLUME') || die;

use Plume\Kernel\Config\Config;

defined('PLUME') || die;

/**
 * undocumented function summary
 *
 * Undocumented function long description
 *
 * @param Type $var Description
 * @return mixed
 * @throws conditon
 **/
function env(string $name)
{
    $name = strtoupper($name);
    return Config::hasDisableFunc('putenv') ? $_ENV[$name] : getenv($name);
}
