<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams['MI_LINK_BUTTON']) && !empty($arParams['MI_LINK_BUTTON'])) {
  $arResult['MI_LINK_BUTTON'] = str_replace('#SITE_DIR#/', SITE_DIR, $arParams['MI_LINK_BUTTON']);
}
