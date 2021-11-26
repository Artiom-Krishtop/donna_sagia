<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$property_value = array_pop($arResult['VARIABLES']);

$preFilter = array(
  "OFFERS" => array(
    'PROPERTY_21' => $property_value,
  )
);

$GLOBALS[$arParams['PREFILTER_NAME']] = $preFilter;

include 'sections.php';
