<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// print_r($arResult);
CUtil::InitJSCore(array('jquery'));
?>

<div class="mobile-menu"><span></span><div><?=GetMessage('B_M_MENU')?></div></div>

<?if (!empty($arResult)):?>
<nav id="navi">
	<ul>

	<?
	foreach($arResult as $arItem):
		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
			continue;
	?>
			<li class="<?=$arItem["PARAMS"]['RED_COLOR'] === 'Y' ? 'opt':'' ?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endforeach?>

	</ul>
</nav>
<?endif?>
