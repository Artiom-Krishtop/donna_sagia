<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "tree",
    Array(
        "ID" => $_REQUEST["ELEMENT_ID"],
        "SECTION_URL" => "/catalog/list.php?SECTION_ID=#SECTION_ID#",
        "IS_SEF" => "N",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "4",
        "DEPTH_LEVEL" => "4",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600"
    )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
