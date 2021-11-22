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

CUtil::InitJSCore(array('jquery', 'jquery.flexslider.js'));

if (isset($arResult['ITEM']))
{
	$item = $arResult['ITEM'];
	$areaId = $arResult['AREA_ID'];
	$itemIds = array(
		'ID' => $areaId,
		'PICT' => $areaId.'_pict',
		'PICT_SLIDER' => $areaId.'_pict_slider',
		'STICKER_ID' => $areaId.'_sticker',
		'PRICE' => $areaId.'_price',
		'PROP_DIV' => $areaId.'_sku_tree',
		'PROP' => $areaId.'_prop_',
		'DISPLAY_PROP_DIV' => $areaId.'_sku_prop',
	);

	$obName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $areaId);

	$productTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $item['NAME'];

	$imgTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $item['NAME'];

	$skuProps = array();

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

	$morePhoto = null;

	$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
	if (isset($actualItem['MORE_PHOTO']))
	{
		$morePhoto = $actualItem['MORE_PHOTO'];
	}

	$showSlider = is_array($morePhoto) && count($morePhoto) > 1;
	// dd($arResult);

	$itemHasDetailUrl = isset($item['DETAIL_PAGE_URL']) && $item['DETAIL_PAGE_URL'] != '';
	?>

	<div class="goods" id="<?=$areaId?>" data-entity="item">
	<?if ($item['LABEL']):?>
		<div class="label" id="<?=$itemIds['STICKER_ID'] ?>">
			<? if (!empty($item['LABEL_ARRAY_VALUE'])): ?>
				<? foreach ($item['LABEL_ARRAY_VALUE'] as $key => $value): ?>
					<div class="<?=strtolower($key); ?>"></div>
				<? endforeach; ?>
			<? endif; ?>
		</div>
	<? endif ;?>

    <div class="goods-inner">
			<!-- <div data-entity="image-wrapper"> -->
    		<div class="goods-slider" <?=($showSlider ? '' : 'style="display: none"') ?>>
					<ul class="slides" >
              <?
							if ($showSlider) {
								foreach ($morePhoto as $key => $photo)
								{
									?>
									<li class="item <?=($key == 0 ? 'active' : '')?>"><img src="<?=$photo['SRC'] ?>"></li>
									<?
								}
							}
        			?>
					</ul>
    		</div>
				<div class="goods-slider" <?=($showSlider ? 'style="display: none"' : '') ?> id="<?=$itemIds['PICT'] ?>">
					<img src="<?=$item['PREVIEW_PICTURE']['SRC']?>">
				</div>

			<!-- </div> -->

				<div class="goods-description">

          <?php if ($itemHasDetailUrl): ?>
          	<h3><a href=<?=$item['DETAIL_PAGE_URL'] ?>><?=$productTitle?></a></h3>
						<?php else: ?>
							<h3><?=$productTitle?></h3>
          <?php endif; ?>

					<div class="cost" id="<?=$itemIds['PRICE']?>"><?= !empty($price)? $price['PRINT_RATIO_PRICE'] : '' ?></div>

					<?
					if (!$haveOffers) {
						if (!empty($item['DISPLAY_PROPERTIES'])) {
							?>
							<div data-entity="props-block">
							<?
							foreach ($item['DISPLAY_PROPERTIES'] as $displayProperty) {
								?>
								<div class="art"><?=$displayProperty['NAME']?> : <?=$displayProperty['DISPLAY_VALUE'] ?></div>
								<?
							}
							?>
							</div>
							<?
						}
					}else {
						$showProductProps = !empty($item['DISPLAY_PROPERTIES']);
						$showOfferProps = $item['OFFERS_PROPS_DISPLAY'];

						if ($showProductProps || $showOfferProps) {
							?>
							<div data-entity="props-block">
							<?
							if ($showProductProps) {
								foreach ($item['DISPLAY_PROPERTIES'] as $displayProperty) {
									?>
									<div class="art"><?=$displayProperty['NAME']?> : <?=$displayProperty['DISPLAY_VALUE'] ?></div>
									<?
								}
							}

							if ($showOfferProps) {
								?>
								<div id="<?=$itemIds['DISPLAY_PROP_DIV'] ?>" style="display: none;"></div>
								<?
							}
							?>
							</div>
							<?
							if ($item['OFFERS_PROPS_DISPLAY'])
							{
								foreach ($item['JS_OFFERS'] as $keyOffer => $jsOffer)
								{
									$strProps = '';

									if (!empty($jsOffer['DISPLAY_PROPERTIES']))
									{
										foreach ($jsOffer['DISPLAY_PROPERTIES'] as $displayProperty)
										{
											$strProps .= '<div class="art">' . $displayProperty['NAME']. ':' . $displayProperty['VALUE']  . '</div>';
										}
									}

									$item['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
								}
								unset($jsOffer, $strProps);
							}
						}
					}

					if (!empty($item['OFFERS_PROP'])) {

						?>
						<div id="<?=$itemIds['PROP_DIV']?>">
							<?
						foreach ($arParams['SKU_PROPS'] as $skuProperty) {

							$propertyId = $skuProperty['ID'];

							$skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);

								if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
									continue;
								?>
								<div class="sizes" data-entity="sku-line-block">
									<div><?= $skuProperty['NAME']?> : </div>
									<ul><?
									foreach ($skuProperty['VALUES'] as $value) {

										if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
											continue;

										$value['NAME'] = htmlspecialcharsbx($value['NAME']);

										if ($skuProperty['SHOW_MODE'] === 'PICT') {
											?>
											<li class="pict" title="<?=$value['NAME']?>"	data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>">
												<div style="width:20px;height:20px;background-image: url('<?=$value['PICT']['SRC']?>');"></div>
											</li>
											<?
										}else {
											?>
											<li class="" title="<?=$value['NAME']?>"	data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>"><?= $value['NAME'] ?></li>
											<?
										}
									}
								?>
								</ul>
							</div>
							<?
							}
							?>
						</div><?

							foreach ($arParams['SKU_PROPS'] as $skuProperty)
							{
								if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']]))
									continue;

								$skuProps[] = array(
									'ID' => $skuProperty['ID'],
									'SHOW_MODE' => $skuProperty['SHOW_MODE'],
									'VALUES' => $skuProperty['VALUES'],
									'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
								);
							}
							unset($skuProperty, $value);
						}
					?>
    </div>
  </div>
</div>

    <?
		if (!$haveOffers)
		{
			$jsParams = array(
				'PRODUCT_TYPE' => $item['PRODUCT']['TYPE'],
				'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
				'SHOW_ADD_BASKET_BTN' => false,
				'SHOW_BUY_BTN' => true,
				'SHOW_ABSENT' => true,
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'BIG_DATA' => $item['BIG_DATA'],
				'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
				'VIEW_MODE' => $arResult['TYPE'],
				'USE_SUBSCRIBE' => $showSubscribe,
				'PRODUCT' => array(
					'ID' => $item['ID'],
					'NAME' => $productTitle,
					'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL'],
					'PICT' => $item['SECOND_PICT'] ? $item['PREVIEW_PICTURE_SECOND'] : $item['PREVIEW_PICTURE'],
					'CAN_BUY' => $item['CAN_BUY'],
					'CHECK_QUANTITY' => $item['CHECK_QUANTITY'],
					'MAX_QUANTITY' => $item['CATALOG_QUANTITY'],
					'STEP_QUANTITY' => $item['ITEM_MEASURE_RATIOS'][$item['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
					'QUANTITY_FLOAT' => is_float($item['ITEM_MEASURE_RATIOS'][$item['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
					'ITEM_PRICE_MODE' => $item['ITEM_PRICE_MODE'],
					'ITEM_PRICES' => $item['ITEM_PRICES'],
					'ITEM_PRICE_SELECTED' => $item['ITEM_PRICE_SELECTED'],
					'ITEM_QUANTITY_RANGES' => $item['ITEM_QUANTITY_RANGES'],
					'ITEM_QUANTITY_RANGE_SELECTED' => $item['ITEM_QUANTITY_RANGE_SELECTED'],
					'ITEM_MEASURE_RATIOS' => $item['ITEM_MEASURE_RATIOS'],
					'ITEM_MEASURE_RATIO_SELECTED' => $item['ITEM_MEASURE_RATIO_SELECTED'],
					'MORE_PHOTO' => $item['MORE_PHOTO'],
					'MORE_PHOTO_COUNT' => $item['MORE_PHOTO_COUNT']
				),
				'BASKET' => array(
					'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
					'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'EMPTY_PROPS' => empty($item['PRODUCT_PROPERTIES']),
					'BASKET_URL' => $arParams['~BASKET_URL'],
					'ADD_URL_TEMPLATE' => $arParams['~ADD_URL_TEMPLATE'],
					'BUY_URL_TEMPLATE' => $arParams['~BUY_URL_TEMPLATE']
				),
				'VISUAL' => array(
					'ID' => $itemIds['ID'],
					'PICT_ID' => $item['SECOND_PICT'] ? $itemIds['SECOND_PICT'] : $itemIds['PICT'],
					'PICT_SLIDER_ID' => $itemIds['PICT_SLIDER'],
					'PRICE_ID' => $itemIds['PRICE'],
				)
			);
		}
		else
		{
			$jsParams = array(
				'PRODUCT_TYPE' => $item['PRODUCT']['TYPE'],
				'SHOW_QUANTITY' => false,
				'SHOW_ADD_BASKET_BTN' => false,
				'SHOW_BUY_BTN' => true,
				'SHOW_ABSENT' => true,
				'SHOW_SKU_PROPS' => false,
				'SECOND_PICT' => $item['SECOND_PICT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
				'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
				'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'BIG_DATA' => $item['BIG_DATA'],
				'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
				'VIEW_MODE' => $arResult['TYPE'],
				'USE_SUBSCRIBE' => $showSubscribe,
				'DEFAULT_PICTURE' => array(
					'PICTURE' => $item['PRODUCT_PREVIEW'],
					'PICTURE_SECOND' => $item['PRODUCT_PREVIEW_SECOND']
				),
				'VISUAL' => array(
					'ID' => $itemIds['ID'],
					'PICT_ID' => $itemIds['PICT'],
					'SECOND_PICT_ID' => $itemIds['SECOND_PICT'],
					'PICT_SLIDER_ID' => $itemIds['PICT_SLIDER'],
					'QUANTITY_ID' => $itemIds['QUANTITY'],
					'QUANTITY_UP_ID' => $itemIds['QUANTITY_UP'],
					'QUANTITY_DOWN_ID' => $itemIds['QUANTITY_DOWN'],
					'QUANTITY_MEASURE' => $itemIds['QUANTITY_MEASURE'],
					'QUANTITY_LIMIT' => $itemIds['QUANTITY_LIMIT'],
					'PRICE_ID' => $itemIds['PRICE'],
					'PRICE_OLD_ID' => $itemIds['PRICE_OLD'],
					'PRICE_TOTAL_ID' => $itemIds['PRICE_TOTAL'],
					'TREE_ID' => $itemIds['PROP_DIV'],
					'TREE_ITEM_ID' => $itemIds['PROP'],
					'BUY_ID' => $itemIds['BUY_LINK'],
					'DSC_PERC' => $itemIds['DSC_PERC'],
					'SECOND_DSC_PERC' => $itemIds['SECOND_DSC_PERC'],
					'DISPLAY_PROP_DIV' => $itemIds['DISPLAY_PROP_DIV'],
					'BASKET_ACTIONS_ID' => $itemIds['BASKET_ACTIONS'],
					'NOT_AVAILABLE_MESS' => $itemIds['NOT_AVAILABLE_MESS'],
					'COMPARE_LINK_ID' => $itemIds['COMPARE_LINK'],
					'SUBSCRIBE_ID' => $itemIds['SUBSCRIBE_LINK']
				),
				'BASKET' => array(
					'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'SKU_PROPS' => $item['OFFERS_PROP_CODES'],
					'BASKET_URL' => $arParams['~BASKET_URL'],
					'ADD_URL_TEMPLATE' => $arParams['~ADD_URL_TEMPLATE'],
					'BUY_URL_TEMPLATE' => $arParams['~BUY_URL_TEMPLATE']
				),
				'PRODUCT' => array(
					'ID' => $item['ID'],
					'NAME' => $productTitle,
					'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL'],
					'MORE_PHOTO' => $item['MORE_PHOTO'],
					'MORE_PHOTO_COUNT' => $item['MORE_PHOTO_COUNT']
				),
				'OFFERS' => array(),
				'OFFER_SELECTED' => 0,
				'TREE_PROPS' => array()
			);

			if (!empty($item['OFFERS_PROP']))
			{
				$jsParams['SHOW_QUANTITY'] = $arParams['USE_PRODUCT_QUANTITY'];
				$jsParams['SHOW_SKU_PROPS'] = $item['OFFERS_PROPS_DISPLAY'];
				$jsParams['OFFERS'] = $item['JS_OFFERS'];
				$jsParams['OFFER_SELECTED'] = $item['OFFERS_SELECTED'];
				$jsParams['TREE_PROPS'] = $skuProps;
			}
		}

		if ($arParams['DISPLAY_COMPARE'])
		{
			$jsParams['COMPARE'] = array(
				'COMPARE_URL_TEMPLATE' => $arParams['~COMPARE_URL_TEMPLATE'],
				'COMPARE_DELETE_URL_TEMPLATE' => $arParams['~COMPARE_DELETE_URL_TEMPLATE'],
				'COMPARE_PATH' => $arParams['COMPARE_PATH']
			);
		}

		if ($item['BIG_DATA'])
		{
			$jsParams['PRODUCT']['RCM_ID'] = $item['RCM_ID'];
		}

		$jsParams['PRODUCT_DISPLAY_MODE'] = $arParams['PRODUCT_DISPLAY_MODE'];
		$jsParams['USE_ENHANCED_ECOMMERCE'] = $arParams['USE_ENHANCED_ECOMMERCE'];
		$jsParams['DATA_LAYER_NAME'] = $arParams['DATA_LAYER_NAME'];
		$jsParams['BRAND_PROPERTY'] = !empty($item['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
			? $item['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
			: null;

		$templateData = array(
			'JS_OBJ' => $obName,
			'ITEM' => array(
				'ID' => $item['ID'],
				'IBLOCK_ID' => $item['IBLOCK_ID'],
				'OFFERS_SELECTED' => $item['OFFERS_SELECTED'],
				'JS_OFFERS' => $item['JS_OFFERS']
			)
		);
		?>

	<?
	unset($item, $actualItem, $minOffer, $itemIds, $jsParams);
}
