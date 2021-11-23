<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// dd($arParams['CUSTOM_FILTER']);
if (isset($arParams['TAG_FILTER']) && !empty($arParams['TAG_FILTER']))
{
  $items = array();
  $arSelect = array('ID');

  $tag = '%' . $arParams['TAG_FILTER'] . '%';

  $arFilter = array('TAGS' => $tag);
  $arFilter = array(array('PROPERTY_12' => 'white'));

  $rsTags = CIblockElement::GetList(array('SORT' => 'ASC'), $arFilter, false, false, $arSelect);

  while ($a = $rsTags->GetNext()) {
    $items[] = $a;
 // echo '<pre>' . print_r($items, 1) . '</pre>';
  }
dd($items);
  $newResult = array();

  foreach ($items as $item) {
    foreach ($arResult['ITEMS'] as $itemRes) {
      if ($item['ID'] == $itemRes['ID']) {
        $newResult[] = $itemRes;
      }
    }
  }

  $arResult['ITEMS'] = $newResult;
}
