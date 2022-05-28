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

/**
 * undocumented function summary
 *
 * Undocumented function long description
 *
 * @param Type $var Description
 * @return type
 * @throws conditon
 **/
function source($file, $line, $limit_line = 15)
{

    ini_set('highlight.default', '"class="default');
    ini_set('highlight.keyword', '"class="keyword');
    ini_set('highlight.string',  '"class="string');
    ini_set('highlight.html',    '"class="html');
    ini_set('highlight.comment', '"class="comment');

    $source = highlight_file($file, true);
    $source = str_replace(["\r\n", "\r", "\n", '<code>','</code>'], '', $source);
    $source = str_replace('style="color: "', '', $source);

    //linea a comensar y terminar
    $start = max($line - ($limit_line - 1) / 2, 1);
    $end = $line + ($limit_line - 1) / 2;

    $out = "";

    foreach (explode("<br />", $source) as $n => $value) {
        $n++;

        if ($n == $line) {
            $out .= "<p class='line-error'><span class='number'>$n </span> $value\n</p>";
        }

        if ($n >= $start && $n != $line && $n <= $end) {
            $out .= "<span class='number'>$n </span> $value\n";
        }
    }

    return "<pre><code>$out</code></pre>";
}

function view(string $filename, array $data, bool $adm = false)
{
    //$file = ($adm) ? PATH_THEMES.env('adm_theme').DS."$filename.php" : PATH_THEMES.env('web_theme').DS."$filename.php" ;
    $file = PATH_THEMES.env('adm_theme').DS."$filename.php";

    foreach ($data as $key => $value) {
        $$key = $value;
    }

    if (file_exists($file)) {
        ob_start();
        include $file;
        return ob_flush();
    }
    throw new Exception("Not Found file <b>$file</b>");
}