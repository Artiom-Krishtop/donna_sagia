<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);

?>
<section id="container">
	<div class="inner">
		<div class="catalog">

			<div class="sidebar-left">
				<div class="drop">Развернуть опции</div>

				<div class="drop-wrap">
					<?include 'menu.php';?>
				</div>
			</div>

			<div class="catalog-content">
			<?
			$componentElementParams = array(
				'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
				'IBLOCK_ID' => $arParams['IBLOCK_ID'],
				'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
				'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
				'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
				'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],

				'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
				'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

				'PROPERTY_CODE' => (isset($arParams['DETAIL_PROPERTY_CODE']) ? $arParams['DETAIL_PROPERTY_CODE'] : []),
				'OFFERS_FIELD_CODE' => $arParams['DETAIL_OFFERS_FIELD_CODE'],
				'OFFERS_PROPERTY_CODE' => (isset($arParams['DETAIL_OFFERS_PROPERTY_CODE']) ? $arParams['DETAIL_OFFERS_PROPERTY_CODE'] : []),
				'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
				'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
				'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
				'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
				'BACKGROUND_IMAGE' => (isset($arParams['DETAIL_BACKGROUND_IMAGE']) ? $arParams['DETAIL_BACKGROUND_IMAGE'] : ''),
				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				'PRODUCT_INFO_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER'] : ''),
				'PRODUCT_PAY_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER'] : ''),
				'MAIN_BLOCK_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE'] : ''),
				'MAIN_BLOCK_OFFERS_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE'] : ''),
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'PROPS_OF_COLOR' => $arParams['PROPS_OF_COLOR'],
				'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
				'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
				'DISPLAY_NAME' => (isset($arParams['DETAIL_DISPLAY_NAME']) ? $arParams['DETAIL_DISPLAY_NAME'] : ''),
				'SHOW_SLIDER' => (isset($arParams['DETAIL_SHOW_SLIDER']) ? $arParams['DETAIL_SHOW_SLIDER'] : ''),
				'DETAIL_PICTURE_MODE' => (isset($arParams['DETAIL_DETAIL_PICTURE_MODE']) ? $arParams['DETAIL_DETAIL_PICTURE_MODE'] : array()),
				'ADD_DETAIL_TO_SLIDER' => (isset($arParams['DETAIL_ADD_DETAIL_TO_SLIDER']) ? $arParams['DETAIL_ADD_DETAIL_TO_SLIDER'] : ''),
				'DISPLAY_PREVIEW_TEXT_MODE' => (isset($arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE']) ? $arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE'] : ''),
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
				'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
				'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
				'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
				'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),
				'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
				'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
				'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
				'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
				'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
				'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
				'BRAND_USE' => (isset($arParams['DETAIL_BRAND_USE']) ? $arParams['DETAIL_BRAND_USE'] : 'N'),
				'BRAND_PROP_CODE' => (isset($arParams['DETAIL_BRAND_PROP_CODE']) ? $arParams['DETAIL_BRAND_PROP_CODE'] : ''),
				'MESS_DESCRIPTION_TAB' => (isset($arParams['~MESS_DESCRIPTION_TAB']) ? $arParams['~MESS_DESCRIPTION_TAB'] : ''),
				'MESS_PROPERTIES_TAB' => (isset($arParams['~MESS_PROPERTIES_TAB']) ? $arParams['~MESS_PROPERTIES_TAB'] : ''),
				'MESS_COMMENTS_TAB' => (isset($arParams['~MESS_COMMENTS_TAB']) ? $arParams['~MESS_COMMENTS_TAB'] : ''),

				'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
				'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
				'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
				'CHECK_SECTION_ID_VARIABLE' => (isset($arParams['DETAIL_CHECK_SECTION_ID_VARIABLE']) ? $arParams['DETAIL_CHECK_SECTION_ID_VARIABLE'] : ''),

				'CACHE_TYPE' => $arParams['CACHE_TYPE'],
				'CACHE_TIME' => $arParams['CACHE_TIME'],
				'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

				'SET_TITLE' => $arParams['SET_TITLE'],
				'SET_CANONICAL_URL' => $arParams['DETAIL_SET_CANONICAL_URL'],
				'META_KEYWORDS' => $arParams['DETAIL_META_KEYWORDS'],
				'META_DESCRIPTION' => $arParams['DETAIL_META_DESCRIPTION'],
				'BROWSER_TITLE' => $arParams['DETAIL_BROWSER_TITLE'],
				'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'],
				'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
				'STRICT_SECTION_CHECK' => (isset($arParams['DETAIL_STRICT_SECTION_CHECK']) ? $arParams['DETAIL_STRICT_SECTION_CHECK'] : ''),
				'ADD_SECTIONS_CHAIN' => (isset($arParams['ADD_SECTIONS_CHAIN']) ? $arParams['ADD_SECTIONS_CHAIN'] : ''),
				'ADD_ELEMENT_CHAIN' => (isset($arParams['ADD_ELEMENT_CHAIN']) ? $arParams['ADD_ELEMENT_CHAIN'] : ''),
				'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
				'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),

				'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
				'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],

				'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),

				'PRICE_CODE' => $arParams['~PRICE_CODE'],
				'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
				'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
				'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
				'PRICE_VAT_SHOW_VALUE' => $arParams['PRICE_VAT_SHOW_VALUE'],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],

				'BASKET_URL' => $arParams['BASKET_URL'],
				'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
				'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
				'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
				'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
				'PRODUCT_PROPERTIES' => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
				'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
				'ADD_TO_BASKET_ACTION' => $basketAction,
				'ADD_TO_BASKET_ACTION_PRIMARY' => (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION_PRIMARY']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION_PRIMARY'] : null),

				'LINK_IBLOCK_TYPE' => $arParams['LINK_IBLOCK_TYPE'],
				'LINK_IBLOCK_ID' => $arParams['LINK_IBLOCK_ID'],
				'LINK_PROPERTY_SID' => $arParams['LINK_PROPERTY_SID'],
				'LINK_ELEMENTS_URL' => $arParams['LINK_ELEMENTS_URL'],

				'USE_GIFTS_DETAIL' => $arParams['USE_GIFTS_DETAIL']?: 'Y',
				'USE_GIFTS_MAIN_PR_SECTION_LIST' => $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST']?: 'Y',

				'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
				'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
				'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

				'MESSAGE_404' => $arParams['~MESSAGE_404'],
				'SET_STATUS_404' => $arParams['SET_STATUS_404'],
				'SHOW_404' => $arParams['SHOW_404'],
				'FILE_404' => $arParams['FILE_404'],

				'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
				'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
				'SET_VIEWED_IN_COMPONENT' => (isset($arParams['DETAIL_SET_VIEWED_IN_COMPONENT']) ? $arParams['DETAIL_SET_VIEWED_IN_COMPONENT'] : ''),
				'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],



				'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],

				'DISCOUNT_PERCENT_POSITION' => (isset($arParams['DISCOUNT_PERCENT_POSITION']) ? $arParams['DISCOUNT_PERCENT_POSITION'] : ''),
				'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
				'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
				'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
				'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),

				'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
				'MESS_PRICE_RANGES_TITLE' => (isset($arParams['~MESS_PRICE_RANGES_TITLE']) ? $arParams['~MESS_PRICE_RANGES_TITLE'] : ''),

				'BLOG_URL' => (isset($arParams['DETAIL_BLOG_URL']) ? $arParams['DETAIL_BLOG_URL'] : ''),
				'BLOG_EMAIL_NOTIFY' => (isset($arParams['DETAIL_BLOG_EMAIL_NOTIFY']) ? $arParams['DETAIL_BLOG_EMAIL_NOTIFY'] : ''),
				'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
				'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
				'IMAGE_RESOLUTION' => (isset($arParams['DETAIL_IMAGE_RESOLUTION']) ? $arParams['DETAIL_IMAGE_RESOLUTION'] : ''),

				'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
				'USE_COMPARE_LIST' => 'Y',
				'SLIDER_INTERVAL' => (isset($arParams['DETAIL_SLIDER_INTERVAL']) ? $arParams['DETAIL_SLIDER_INTERVAL'] : ''),
				'SLIDER_PROGRESS' => (isset($arParams['DETAIL_SLIDER_PROGRESS']) ? $arParams['DETAIL_SLIDER_PROGRESS'] : ''),
			);

			if (isset($arParams['USER_CONSENT']))
			{
				$componentElementParams['USER_CONSENT'] = $arParams['USER_CONSENT'];
			}

			if (isset($arParams['USER_CONSENT_ID']))
			{
				$componentElementParams['USER_CONSENT_ID'] = $arParams['USER_CONSENT_ID'];
			}

			if (isset($arParams['USER_CONSENT_IS_CHECKED']))
			{
				$componentElementParams['USER_CONSENT_IS_CHECKED'] = $arParams['USER_CONSENT_IS_CHECKED'];
			}

			if (isset($arParams['USER_CONSENT_IS_LOADED']))
			{
				$componentElementParams['USER_CONSENT_IS_LOADED'] = $arParams['USER_CONSENT_IS_LOADED'];
			}

			$elementId = $APPLICATION->IncludeComponent(
				'bitrix:catalog.element',
				'donna',
				$componentElementParams,
				$component
			);
			$GLOBALS['CATALOG_CURRENT_ELEMENT_ID'] = $elementId;


			?>
				<div class="tab-box">
					<ul class="tab-list">
						<li class="active"><a href="#tab-1">Похожие товары</a></li>
						<li><a href="#tab-2">Вы уже смотрели</a></li>
						<li><a href="#tab-3">Отзывы</a></li>
					</ul>

					<div class="tab-block">
						<div class="active tab" id="tab-1">
							<?
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.section',
								'donna_showes',
								array(
									'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
									'IBLOCK_ID' => $arParams['IBLOCK_ID'],
									'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
									'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
									'ELEMENT_SORT_FIELD' => 'shows',
									'ELEMENT_SORT_ORDER' => 'desc',
									'ELEMENT_SORT_FIELD2' => 'sort',
									'ELEMENT_SORT_ORDER2' => 'asc',
									'PROPERTY_CODE' => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
									'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
									'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
									'BASKET_URL' => $arParams['BASKET_URL'],
									'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
									'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
									'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
									'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
									'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
									'CACHE_TYPE' => $arParams['CACHE_TYPE'],
									'CACHE_TIME' => $arParams['CACHE_TIME'],
									'CACHE_FILTER' => $arParams['CACHE_FILTER'],
									'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
									'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
									'PRICE_CODE' => $arParams['~PRICE_CODE'],
									'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
									'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
									'PAGE_ELEMENT_COUNT' => 6,
									'FILTER_IDS' => array($elementId),

									"SET_TITLE" => "N",
									"SET_BROWSER_TITLE" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_LAST_MODIFIED" => "N",
									"ADD_SECTIONS_CHAIN" => "N",

									'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
									'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
									'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
									'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
									'PRODUCT_PROPERTIES' => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),

									'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
									'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
									'OFFERS_PROPERTY_CODE' => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
									'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
									'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
									'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
									'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
									'OFFERS_LIMIT' => (isset($arParams['LIST_OFFERS_LIMIT']) ? $arParams['LIST_OFFERS_LIMIT'] : 0),

									'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
									'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
									'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],
									'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
									'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

									'LABEL_PROP' => $arParams['LABEL_PROP'],
									'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
									'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
									'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
									'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
									'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
									'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
									'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
									'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
									'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
									'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
									'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

									'DISPLAY_TOP_PAGER' => 'N',
									'DISPLAY_BOTTOM_PAGER' => 'N',
									'HIDE_SECTION_DESCRIPTION' => 'Y',

									'RCM_TYPE' => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
									'RCM_PROD_ID' => $elementId,
									'SHOW_FROM_SECTION' => 'Y',

									'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
									'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
									'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
									'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
									'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
									'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
									'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
									'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
									'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
									'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
									'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
									'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
									'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
									'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
									'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
									'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
									'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

									'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
									'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
									'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

									'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									'ADD_TO_BASKET_ACTION' => $basketAction,
									'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
									'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
									'COMPARE_NAME' => $arParams['COMPARE_NAME'],
									'USE_COMPARE_LIST' => 'Y',
									'BACKGROUND_IMAGE' => '',
									'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
								),
								$component
							);
							?>
						</div>
						<div class="tab" id="tab-2">
							<?
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.products.viewed',
								'donna',
								array(
									'IBLOCK_MODE' => 'single',
									'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
									'IBLOCK_ID' => $arParams['IBLOCK_ID'],
									'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
									'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
									'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
									'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
									'PROPERTY_CODE_'.$arParams['IBLOCK_ID'] => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
									'PROPERTY_CODE_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
									'PROPERTY_CODE_MOBILE'.$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE_MOBILE'],
									'BASKET_URL' => $arParams['BASKET_URL'],
									'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
									'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
									'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
									'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
									'CACHE_TYPE' => $arParams['CACHE_TYPE'],
									'CACHE_TIME' => $arParams['CACHE_TIME'],
									'CACHE_FILTER' => $arParams['CACHE_FILTER'],
									'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
									'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
									'PRICE_CODE' => $arParams['~PRICE_CODE'],
									'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
									'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
									'PAGE_ELEMENT_COUNT' => 6,
									'SECTION_ELEMENT_ID' => $elementId,

									"SET_TITLE" => "N",
									"SET_BROWSER_TITLE" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_LAST_MODIFIED" => "N",
									"ADD_SECTIONS_CHAIN" => "N",

									'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
									'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
									'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
									'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
									'CART_PROPERTIES_'.$arParams['IBLOCK_ID'] => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
									'CART_PROPERTIES_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
									'ADDITIONAL_PICT_PROP_'.$arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
									'ADDITIONAL_PICT_PROP_'.$recommendedData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],

									'SHOW_FROM_SECTION' => 'N',
									'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],
									'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
									'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

									'LABEL_PROP_'.$arParams['IBLOCK_ID'] => $arParams['LABEL_PROP'],
									'LABEL_PROP_MOBILE_'.$arParams['IBLOCK_ID'] => $arParams['LABEL_PROP_MOBILE'],
									'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
									'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
									'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
									'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
									'ENLARGE_PROP_'.$arParams['IBLOCK_ID'] => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
									'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
									'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
									'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

									'OFFER_TREE_PROPS_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
									'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
									'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
									'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
									'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
									'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
									'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
									'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
									'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
									'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
									'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
									'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
									'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
									'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
									'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
									'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

									'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
									'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
									'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

									'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									'ADD_TO_BASKET_ACTION' => $basketAction,
									'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
									'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
									'COMPARE_NAME' => $arParams['COMPARE_NAME'],
									'USE_COMPARE_LIST' => 'Y'
								),
								$component
							);
							?>

						</div>
						<div class="tab" id="tab-3">
							<!-- <p style="font-size: 2rem;">Отзывы</p> -->
							<?php
							// echo '<pre>'.print_r($arParams).'</pre>';

							// foreach ($arParams as $key => $value) {
							// 	echo $key.'------'. $value;
							// 	echo '<br>';
							// }
							$componentCommentsParams = array(
								'ELEMENT_ID' => $elementId,
								'ELEMENT_CODE' => '',
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],
								'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
								'URL_TO_COMMENT' => '',
								'WIDTH' => '',
								'COMMENTS_COUNT' => '5',
								'BLOG_USE' => $arParams['DETAIL_BLOG_USE'],
								'FB_USE' => $arParams['DETAIL_FB_USE'],
								'FB_APP_ID' => $arParams['DETAIL_FB_APP_ID'],
								'VK_USE' => $arParams['DETAIL_VK_USE'],
								'VK_API_ID' => $arParams['DETAIL_VK_API_ID'],
								'CACHE_TYPE' => $arParams['CACHE_TYPE'],
								'CACHE_TIME' => $arParams['CACHE_TIME'],
								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
								'BLOG_TITLE' => 'отзывы',
								'BLOG_URL' => $arParams['DETAIL_BLOG_URL'],
								'PATH_TO_SMILE' => '',
								'EMAIL_NOTIFY' => $arParams['DETAIL_BLOG_EMAIL_NOTIFY'],
								'AJAX_POST' => 'Y',
								'SHOW_SPAM' => 'Y',
								'SHOW_RATING' => 'N',
								'FB_TITLE' => '',
								'FB_USER_ADMIN_ID' => '',
								'FB_COLORSCHEME' => 'light',
								'FB_ORDER_BY' => 'reverse_time',
								'VK_TITLE' => '',
								'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
							);
							if(isset($arParams["USER_CONSENT"]))
								$componentCommentsParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
							if(isset($arParams["USER_CONSENT_ID"]))
								$componentCommentsParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
							if(isset($arParams["USER_CONSENT_IS_CHECKED"]))
								$componentCommentsParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
							if(isset($arParams["USER_CONSENT_IS_LOADED"]))
								$componentCommentsParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];

							$APPLICATION->IncludeComponent(
								'bitrix:catalog.comments',
								'',
								$componentCommentsParams,
								$component,
								array('HIDE_ICONS' => 'Y')
							);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
