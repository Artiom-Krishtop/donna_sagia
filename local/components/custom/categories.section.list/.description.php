<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage('IBLOCK_TITLE_LIST_NAME'),
	"DESCRIPTION" => GetMessage('IBLOCK_TITLE_LIST_DESCRIPTION'),
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
