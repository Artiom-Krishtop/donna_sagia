<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$this->setFrameMode(true);

if (isset($arResult['ITEM']))
{
	$item = $arResult['ITEM'];

  $haveOffers = !empty($item['OFFERS']);
  if ($haveOffers)
	{
		$actualItem = isset($item['OFFERS'][$item['OFFERS_SELECTED']])
			? $item['OFFERS'][$item['OFFERS_SELECTED']]
			: reset($item['OFFERS']);
	}
	else
	{
		$actualItem = $item;
	}

  $price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];

  $itemHasDetailUrl = isset($item['DETAIL_PAGE_URL']) && $item['DETAIL_PAGE_URL'] != '';

  $productTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $item['NAME'];

  ?>
  <a href="<?=$itemHasDetailUrl ? $item['DETAIL_PAGE_URL'] : 'javascript:void(0)'?>">
    <span class="relative-img"><img src="<?=$item['PREVIEW_PICTURE']['SRC'] ?>"/></span>
    <span class="relative-title"><?=$productTitle?></span>
    <span class="relative-title"><?=$price['PRINT_RATIO_PRICE']?></span>
  </a>
  <?
}
