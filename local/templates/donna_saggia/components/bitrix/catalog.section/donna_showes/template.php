<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
* @global CMain $APPLICATION
* @var array $arParams
* @var array $arResult
* @var CatalogSectionComponent $component
* @var CBitrixComponentTemplate $this
* @var string $templateName
* @var string $componentPath
*
*  _________________________________________________________________________
* |	Attention!
* |	The following comments are for system use
* |	and are required for the component to work correctly in ajax mode:
* |	<!-- items-container -->
* |	<!-- pagination-container -->
* |	<!-- component-end -->
*/
 print_r($arParams['DETAIL_URL']);
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
