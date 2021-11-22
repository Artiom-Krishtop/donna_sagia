<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage('C_S_IBLOCK_ELEMENTS'),
	"DESCRIPTION" => GetMessage('C_S_IBLOCK_ON_SLIDER'),
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "catalog",
			"NAME" => GetMessage('T_IBLOCK_CATALOG_NAME'),
		)
	),
	"CACHE_PATH" => "Y",
);
?>
