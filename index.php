<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");

$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "standard.php",
		"PATH" => "include/banner.php",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?$APPLICATION->IncludeComponent(
	"custom:categories.section.list", 
	".default", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"COUNT_ELEMENT_PAGE" => "5",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "catalog",
		"PROPERTY_TO_DISPLAY_ELEMENTS" => "UF_PEVIEW_PAGE",
		"SECTION_SORT_FIELDS" => "TIMESTAMP_X",
		"SECTION_SORT_ORDER" => "desc"
	),
	false
);?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"donna",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "donna",
		"DETAIL_URL" => "#SITE_DIR#/company/news/detail.php?ID=#ELEMENT_ID#",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "2",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "150",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"URL_LIST_NEWS" => "#SITE_DIR#/company/news/"
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"donna", 
	array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => "donna",
		"MI_ADD_BUTTON" => "Y",
		"MI_NAME_BUTTON" => "Галерея",
		"MI_LINK_BUTTON" => "/galereya/"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
