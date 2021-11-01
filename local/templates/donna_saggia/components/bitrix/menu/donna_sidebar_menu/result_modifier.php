<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult as $key=>$arItem) {
  if ($arItem['DEPTH_LEVEL'] === 1) {
    unset($arResult[$key]);
  }
}
