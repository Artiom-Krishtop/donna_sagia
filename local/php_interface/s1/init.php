<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arJsConfig = array(
    'slick.min.js' => array(
        'js' => '/local/templates/donna_saggia/scripts/slick.min.js',
        'rel' => array(),
    ),
    'jquery.zoom.min.js' => array(
        'js' => '/local/templates/donna_saggia/scripts/jquery.zoom.min.js',
        'rel' => array(),
    ),
    'jquery.fancybox.js' => array(
        'js' => '/local/templates/donna_saggia/scripts/jquery.fancybox.js',
        'rel' => array(),
    ),
    'jquery.flexslider.js' => array(
        'js' => '/local/templates/donna_saggia/scripts/jquery.flexslider.js',
        'rel' => array(),
    ),

);

foreach ($arJsConfig as $ext => $arExt) {
    \CJSCore::RegisterExt($ext, $arExt);
}


function dd($print)
{
  echo "<pre>".print_r($print, 1). "<pre/>";
  die();
}
