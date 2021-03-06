<?php
defined('PLUME') || die;

/**
 * @package Autoload PSR4
 */

$namespace = [
    'Plume' => '',
    'Plume\Kernel' => 'src/framework'
];

spl_autoload_register(function ($class) use ($namespace) {
    foreach ($namespace as $key => $value) {
        $len = strlen($key);
        $file = str_replace(['\\', '/'], DS, ABS_PATH . $value . substr($class, $len) . '.php');

        if (is_readable($file)) {
            return require_once $file;
        }
    }
    die("<pre>Error: The class <b>{$class}</b> Not found</pre>");
});
