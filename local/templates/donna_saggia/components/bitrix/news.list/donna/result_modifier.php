<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams['URL_LIST_NEWS']) && !empty($arParams['URL_LIST_NEWS'])) {
  $arResult['URL_LIST_NEWS'] = str_replace('#SITE_DIR#/', SITE_DIR, $arParams['URL_LIST_NEWS']);
}
