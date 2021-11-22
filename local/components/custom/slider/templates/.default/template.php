<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);

CUtil::InitJSCore(array('jquery','jquery.flexslider.js'));
?>

<div class="carousel">
  <ul class="slides">
    <?php foreach ($arResult['ELEMENTS'] as $key => $item): ?>
      <li style="background-image: url(<?=$item['DETAIL_PICTURE']['SRC']?>);"></li>
    <?php endforeach; ?>
  </ul>
</div>
