<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<span class="add-click" id="oneClickButton" href="javascript:void(0);">Купить в один клик</span>
<div id="contact-form-area"></div>
<?

$jsParams = array(
  'CURRENCY' => $arParams['CURRENCY'],
);

if (!empty($arParams['ID'])) {
  $jsParams['ID'] = $arParams['ID'];
  $jsParams['EMPTY_BASKET'] = true;
}
?>

<script>
  var oneClickButton = new oneClickBuy(<?=CUtil::PhpToJSObject($jsParams)?>);
</script>
