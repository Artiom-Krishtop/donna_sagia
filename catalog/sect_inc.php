<div class="sidebar-left">

	<?$APPLICATION->IncludeComponent(
		"bitrix:menu",
		"donna_sidebar_menu",
		Array(
			"ALLOW_MULTI_SELECT" => "N",
			"CHILD_MENU_TYPE" => "podmenu",
			"DELAY" => "N",
			"MAX_LEVEL" => "4",
			"MENU_CACHE_GET_VARS" => array(""),
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_USE_GROUPS" => "Y",
			"MENU_THEME" => "site",
			"ROOT_MENU_TYPE" => "left",
			"USE_EXT" => "Y"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.smart.filter",
		"donna_smart_filter",
		Array(
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CONVERT_CURRENCY" => "N",
			"DISPLAY_ELEMENT_COUNT" => "Y",
			"FILTER_NAME" => "arrFilter",
			"FILTER_VIEW_MODE" => "vertical",
			"HIDE_NOT_AVAILABLE" => "N",
			"IBLOCK_ID" => "4",
			"IBLOCK_TYPE" => "catalog",
			"PAGER_PARAMS_NAME" => "arrPager",
			"POPUP_POSITION" => "left",
			"PREFILTER_NAME" => "smartPreFilter",
			"PRICE_CODE" => array("BASE"),
			"SAVE_IN_SESSION" => "N",
			"SECTION_CODE" => "dress",
			"SECTION_DESCRIPTION" => "-",
			"SECTION_ID" => $_REQUEST["SECTION_ID"],
			"SECTION_TITLE" => "-",
			"SEF_MODE" => "N",
			"TEMPLATE_THEME" => "blue",
			"XML_EXPORT" => "N"
		)
	);?>
</div>
