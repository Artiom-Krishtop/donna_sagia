<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<section id="container">
	<section class="description">
		<div class="inner">

      <?if($arResult["FILE"] <> '') include($arResult["FILE"]);?>

      <?if ($arParams['MI_ADD_BUTTON'] === 'Y' && !empty($arParams['MI_NAME_BUTTON'])): ?>
        <div class="button-section">
          <a class="see-all" href="<?=!empty($arResult['MI_LINK_BUTTON']) && $arResult['MI_LINK_BUTTON'] !== " " ? $arResult['MI_LINK_BUTTON'] : 'javascript:void(0)'?>">
            <?=$arParams['MI_NAME_BUTTON'] ?>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</section>
