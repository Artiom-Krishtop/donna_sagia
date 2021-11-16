<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Iblock;

define(MAX_COUNT_SECTIONS, 5);

if (!isset($arParams['CACHE_TIME'])) {
  $arParams['CACHE_TIME'] = 36000000;
}

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arResult['SECTIONS'] = array();

if ($this->startResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()))))
{
  if(!Loader::includeModule("iblock"))
  	{
  		$this->abortResultCache();
  		ShowError(Loc::getMessage("IBLOCK_MODULE_NOT_INSTALLED"));
  		return;
  	}

	$existIblock = Iblock\IblockSiteTable::getList(array(
		'select' => array('IBLOCK_ID'),
		'filter' => array('=IBLOCK_ID' => $arParams['IBLOCK_ID'], '=SITE_ID' => SITE_ID, '=IBLOCK.ACTIVE' => 'Y')
	))->fetch();

	if (empty($existIblock))
	{
		$this->abortResultCache();
		return;
	}
	$sort = isset($arParams["SECTION_SORT_FIELDS"])? $arParams["SECTION_SORT_FIELDS"] : "ID";
	$order = isset($arParams["SECTION_SORT_ORDER"])? $arParams["SECTION_SORT_ORDER"] : "asc";

	$arOrder = array($sort => $order);

  $arSelect = array(
    'ID',
    'IBLOCK_ID',
    'NAME',
    'SECTION_PAGE_URL',
    'PICTURE',
    $arParams['PROPERTY_TO_DISPLAY_ELEMENTS']
  );

  $arFilter = array(
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ACTIVE' => 'Y',
    $arParams['PROPERTY_TO_DISPLAY_ELEMENTS'] => true,
  );

  $rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);

	$counter = 0;

  while ($arSection = $rsSections->GetNext()) {
    $arResult['SECTIONS'][] = $arSection;
		$counter++;

		if ($counter === MAX_COUNT_SECTIONS) {
			break;
		}
  }
  unset($arSection, $arSelect, $arFilter, $arOrder, $order, $sort);

  foreach ($arResult['SECTIONS'] as &$arSection) {
    if (!empty($arSection['PICTURE'])) {
      $imageData = CFile::getFileArray($arSection['PICTURE']);
      $arSection['PICTURE'] = $imageData;
    }
  }
  unset($arSection, $imageData);

  $this->includeComponentTemplate();
}
