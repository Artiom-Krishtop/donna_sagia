<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//print_r($arResult) ?>
<?if (!empty($arResult)):?>
  <div class="side-menu">
    <ul>
    <?
    $previousLevel = 0;

    foreach($arResult as $arItem):
    ?>
    	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
    		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    	<?endif?>

    	<?if ($arItem["IS_PARENT"]):?>
    			<li ><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            <ul>
    	<?else:?>

    		<?if ($arItem["PERMISSION"] > "D"):?>
    				<li class="<?=$arItem['SELECTED'] ? 'current' : ''  ?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    		<?endif?>

    	<?endif?>

    	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

    <?endforeach?>

    <?if ($previousLevel > 1)://close last item tags?>
    	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>

    </ul>
  </div>

<?endif?>
