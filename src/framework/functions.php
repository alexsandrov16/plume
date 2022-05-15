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
function source($file, $line, $limit_line = 35)
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
            $out .= "<span class='line-error'><span class='number'>$n </span> $value\n</span>";
        }

        if ($n >= $start && $n != $line && $n <= $end) {
            $out .= "<span class='number'>$n </span> $value\n";
        }
    }

    return "<pre><code>$out</code></pre>";
}
