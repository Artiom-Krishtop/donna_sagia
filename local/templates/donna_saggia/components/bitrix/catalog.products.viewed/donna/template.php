<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
* @global CMain $APPLICATION
* @var array $arParams
* @var array $arResult
* @var CatalogSectionComponent $component
* @var CBitrixComponentTemplate $this
* @var string $templateName
* @var string $componentPath
*/

$this->setFrameMode(true);

if (!empty($arResult['ITEMS']))
{
  foreach ($arResult['ITEMS'] as $item)
  {
    // items-container
    $APPLICATION->IncludeComponent(
    'bitrix:catalog.item',
    'donna_showes',
    array(
     'RESULT' => array(
       'ITEM' => $item,
       ),
      ),
      $component,
      array('HIDE_ICONS' => 'Y')
      );
  }
}
