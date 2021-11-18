<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

if (isset($arParams['PROPS_OF_COLOR']) && !empty($arParams['PROPS_OF_COLOR']) && array_key_exists($arParams['PROPS_OF_COLOR'], $arResult['PROPERTIES'])) {

  $propertyFilterKey = 'PROPERTY_' . $arParams['PROPS_OF_COLOR'];
  $propValue = $arResult['PROPERTIES'][$arParams['PROPS_OF_COLOR']]['VALUE'];
  $propValue = substr($propValue, 0 ,strrpos($propValue, '-') + 1);
  $propertyFilterValue = $propValue . '%';

  $arFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ACTIVE' => 'Y',
    $propertyFilterKey => $propertyFilterValue
  );

  $arSelect = array(
    'IBLOCK_ID',
    'ID',
    'DETAIL_PAGE_URL',
    'DETAIL_PICTURE',
  );

  $rsElem = CIBlockElement::GetList(array('SORT' => 'ASC'), $arFilter, false, false, $arSelect);
  while ($elem = $rsElem->GetNext()) {

    if ($elem['ID'] == $arResult['ID']) {
      $elem['SELECTED'] = true;
    }

    $elem['DETAIL_PICTURE_SRC'] = CFile::GetPath((int)$elem['DETAIL_PICTURE']);

    $arResult['PROPS_OF_COLOR'][] = $elem;
  }
  unset($arFilter, $arSelect, $rsElem, $elem, $propertyFilterKey, $propertyFilterValue, $propValue);
}
