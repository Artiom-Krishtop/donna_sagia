<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);

?>
<div class="filter">
	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">

		<?foreach($arResult["HIDDEN"] as $arItem):?>
		<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
		<?endforeach;?>

			<?
			//not prices
			foreach($arResult["ITEMS"] as $key=>$arItem)
			{
				if(
					empty($arItem["VALUES"])
					|| isset($arItem["PRICE"])
				)
					continue;

				if (
					$arItem["DISPLAY_TYPE"] == "A"
					&& (
						$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
					)
				)
					continue;
				?>
				<div class="filter-wrap">
					<div class="title-filter"><?=$arItem['NAME'] ?></div>
					<span class="filter-container-modef"></span>
					<?
					switch ($arItem["DISPLAY_TYPE"])
					{
						case "A"://NUMBERS_WITH_SLIDER

							$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
							?>

							<input
								class="min-price"
								type="hidden"
								name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
								id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
								value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
								size="5"
								onkeyup="smartFilter.keyup(this)"
							/>
							<input
								class="max-price"
								type="hidden"
								name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
								id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
								value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
								size="5"
								onkeyup="smartFilter.keyup(this)"
							/>

							<div class="title-filter"><?=$arItem['NAME'] ?></div>
							<div class="slider-range" id="drag_tracker_<?=$key?>">
								<div id="drag_track_<?=$key?>">
									<div class="ui-widget-header"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
									<a class="ui-slider-handle"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
									<a class="ui-slider-handle" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
								</div>
							</div>
							<div class="range-min" id="range_Min<?=$key?>"></div>
							<div class="range-max" id="range_Max<?=$key?>"></div>
							<?
							$arJsParams = array(
								"leftSlider" => 'left_slider_'.$key,
								"rightSlider" => 'right_slider_'.$key,
								"tracker" => "drag_tracker_".$key,
								"trackerWrap" => "drag_track_".$key,
								"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
								"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
								"rangeMin" =>'range_Min'.$key,
								"rangeMax" =>'range_Max'.$key,
								"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
								"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
								"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
								"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
								"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
								"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
								"precision" => $precision,
								"colorAvailableActive" => 'colorAvailableActive_'.$key,
							);
							?>
							<script type="text/javascript">
								BX.ready(function(){
									window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
								});
							</script>
							<?
							break;

						case "G"://CHECKBOXES_WITH_PICTURES
							?>
							<ul class="color-filter">
								<?foreach ($arItem["VALUES"] as $val => $ar):?>
									<li class="<?=$ar['CHECKED'] ? 'active' : ''?>">
										<input
										style="display: none"
										type="checkbox"
										name="<?=$ar["CONTROL_NAME"]?>"
										id="<?=$ar["CONTROL_ID"]?>"
										value="<?=$ar["HTML_VALUE"]?>"
										<?=$ar["CHECKED"]? 'checked="checked"': '' ?>
										/>
										<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(BX.findParent(this, {'tag':'li'}), 'active')">
											<? if (isset($ar['FILE']) && !empty($ar['FILE']['SRC'])): ?>
												<span style="background-image:url('<?=$ar['FILE']['SRC'] ?>');"></span>
											<? endif; ?>
										</label>
									</li>
								<?endforeach?>
							</ul>

							<?
							break;

						default://CHECKBOXES
							?>
							<ul>
								<?foreach($arItem["VALUES"] as $val => $ar):?>
									<li>
										<input
										id="<?=$ar['CONTROL_ID'] ?>"
										type="checkbox"
										name="<?=$ar['CONTROL_NAME']?>"
										value="<?=$ar['HTML_VALUE']?>"
										onclick="smartFilter.click(this)"
										<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>>
										<label class="checkbox-label" for="<?=$ar['CONTROL_ID']?>" data-role="label_<?=$ar["CONTROL_ID"]?>"><?=$ar['VALUE'] ?></label>
									</li>
								<?endforeach;?>
							</ul>
					<?
					}
					?>
				</div>
				<div style="clear: both"></div>
			<?
			}
			?>
			<div class="filter-wrap">
				<span class="filter-container-modef"></span>


				<?
				foreach ($arResult['ITEMS'] as $key => $arItem) {

					$key = $arItem['ENCODED_ID'];

					if(isset($arItem["PRICE"])):
						if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
							continue;
						?>
						<input
							class="min-price"
							type="hidden"
							name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
							id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
							value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
							size="5"
							onkeyup="smartFilter.keyup(this)"
						/>
						<input
							class="max-price"
							type="hidden"
							name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
							id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
							value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
							size="5"
							onkeyup="smartFilter.keyup(this)"
						/>

						<div class="title-filter"><?=$arItem['NAME'] ?></div>
						<div class="slider-range" id="drag_tracker_<?=$key?>">
							<div id="drag_track_<?=$key?>">
								<div class="ui-widget-header"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
								<a class="ui-slider-handle"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
								<a class="ui-slider-handle" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
							</div>
						</div>
						<div class="range-min" id="range_Min<?=$key?>"><?= $arItem["VALUES"]["MIN"]["HTML_VALUE"]?></div>
						<div class="range-max" id="range_Max<?=$key?>"><?= $arItem["VALUES"]["MAX"]["HTML_VALUE"]?></div>
						<?
						$arJsParams = array(
							"leftSlider" => 'left_slider_'.$key,
							"rightSlider" => 'right_slider_'.$key,
							"tracker" => "drag_tracker_".$key,
							"trackerWrap" => "drag_track_".$key,
							"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
							"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
							"rangeMin" =>'range_Min'.$key,
							"rangeMax" =>'range_Max'.$key,
							"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
							"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
							"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
							"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
							"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
							"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
							"precision" => $precision,
							"colorAvailableActive" => 'colorAvailableActive_'.$key,
						);
						?>
						<script type="text/javascript">
							BX.ready(function(){
								window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
							});
						</script>
					<?endif;
				}
				?>

				<input
					class="choose"
					type="submit"
					id="set_filter"
					name="set_filter"
					value="Подобрать"
				/>
				<div class="result" id="modef" style="display:<?=!isset($arResult["ELEMENT_COUNT"]) ? 'none' : 'inline-block' ?>">
					<div id="modef_num">
						Найдено: <?=intval($arResult["ELEMENT_COUNT"]) ?> товаров
					</div>
				</div>
			</div>
		<div class="clb"></div>
	</form>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
