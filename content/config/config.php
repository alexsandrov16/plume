<?php

return [
    //Nombre del sitio`
    'title'          => 'Mi Sitio',
    //descripcion o slogan
    'description'    => 'Sitio de pruebas',
    //url
    'base_url'       => $url,
    //index -se puede eliminar-
    'index'          => rtrim($uri->getPath(), '/'),
    //activar modo debug
    'debug'          => false,
    //barra de herramientas 
    'debug_toolbar'  => true,
    //plantilla
    'template'       => 'default',
    //zona horaria
    'timezone'       => 'America/Havana',
    //formato de fecha y hora
    'time_format'    => 'Y-m-d H:i:s',
    //idioma
    'language'       => 'es-ES',
    //charsset
    'charset'        => 'UTF-8',
    //nombre de la session
    'session_name'   => 'fp-site',
    //usuario root
    'root'           => false,
];