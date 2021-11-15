<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Iblock;

if (!isset($arParams['CACHE_TIME'])) {
  $arParams['CACHE_TIME'] = 36000000;
}

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["COUNT_ELEMENT_PAGE"] = intval($arParams["COUNT_ELEMENT_PAGE"]);


// $arParams["SECTION_URL"]=trim($arParams["SECTION_URL"]);

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
    $arParams['PROPERTY_TO_DISPLAY_ELEMENTS'] => true
  );

  $rsSections = CIBlockSection::GetList(array('ID' => 'ASC'), $arFilter, false, $arSelect);

  while ($arSection = $rsSections->fetch()) {
    $arResult['SECTIONS'][] = $arSection;
  }
  unset($arSection, $arSelect, $arFilter);

  foreach ($arResult['SECTIONS'] as &$arSection) {
    if (!empty($arSection['PICTURE'])) {
      $imageData = CFile::getFileArray($arSection['PICTURE']);
      $arSection['PICTURE'] = $imageData;
    }
  }
  // print_r($arResult['SECTIONS']);
  unset($arSection, $imageData);
  $this->setResultCacheKeys(array('SECTIONS'));
  $this->includeComponentTemplate();
}

// $print = CIBlockSection::GetList(array('ID' => 'ASC'), array('IBLOCK_ID' => $arParams['IBLOCK_ID']),false,array($arParams['PROPERTY_TO_DISPLAY_ELEMENTS']));
// while ($rprint = $print->fetch()) {
// print_r($rprint);
//   // echo '<pre>' . print_r($print) . '</pre>';
// }
