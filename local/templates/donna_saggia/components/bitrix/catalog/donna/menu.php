<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->IncludeComponent(
  "bitrix:menu",
  "donna_sidebar_menu",
  array(
    "ROOT_MENU_TYPE" => $arParams['ROOT_MENU_TYPE'],
    "MAX_LEVEL" => $arParams["SECTION_TOP_DEPTH"],
    "CHILD_MENU_TYPE" => $arParams['CHILD_MENU_TYPE'],
    "USE_EXT" => $arParams['USE_EXT'],
    "DELAY" => "N",
    "ALLOW_MULTI_SELECT" => "N",
    "MENU_CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "MENU_CACHE_TIME" => $arParams["CACHE_TIME"],
    "MENU_CACHE_USE_GROUPS" => $arParams["CACHE_GROUPS"],
    "MENU_CACHE_GET_VARS" => ""
    )
  );
