<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

		<div class="news-item">
			<div class="news-image">
				<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>">
					<img
					 src="<? echo $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
				</a>
			</div>

			<div class="news-description">

				<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
					<div class="date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
				<?endif?>

				<h3><a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem['NAME']; ?></a></h3>

				<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
				<p><? echo $arItem["PREVIEW_TEXT"]; ?></p>
				<? endif; ?>


				<a class="more" href="<? echo $arItem["DETAIL_PAGE_URL"] ?>">Подробнее..</a>
			</div>
		</div>

  <?php endforeach; ?>
