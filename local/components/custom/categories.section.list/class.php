<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @var array $this->arParams */
/** @var array $this->arResult */

use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Iblock;

define(MAX_COUNT_SECTIONS, 5);

class CategoriesSectionList extends CBitrixComponent
{

  function onPrepareComponentParams($arParams)
  {
		if (!isset($arParams['CACHE_TIME'])) {
  		$arParams['CACHE_TIME'] = 36000000;
		}

		$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
		$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

    return $arParams;
  }

	protected function checkIncludeModule()
	{
		if(!Loader::includeModule("iblock"))
  	{
  		$this->abortResultCache();
  		ShowError(Loc::getMessage("IBLOCK_MODULE_NOT_INSTALLED"));
  		return;
  	}
	}

	protected function checkExistIBlock()
	{
		$existIblock = Iblock\IblockSiteTable::getList(array(
			'select' => array('IBLOCK_ID'),
			'filter' => array('=IBLOCK_ID' => $arParams['IBLOCK_ID'], '=SITE_ID' => SITE_ID, '=IBLOCK.ACTIVE' => 'Y')
		))->fetch();

		if (empty($existIblock))
		{
			$this->abortResultCache();
			return;
		}
	}

	protected function getResult(&$result)
	{
		$sort = isset($this->arParams["SECTION_SORT_FIELDS"])? $this->arParams["SECTION_SORT_FIELDS"] : "ID";
		$order = isset($this->arParams["SECTION_SORT_ORDER"])? $this->arParams["SECTION_SORT_ORDER"] : "asc";

		$arOrder = array($sort => $order);

	  $arSelect = array(
	    'ID',
	    'IBLOCK_ID',
	    'NAME',
	    'SECTION_PAGE_URL',
	    'PICTURE',
	    $this->arParams['PROPERTY_TO_DISPLAY_ELEMENTS']
	  );

	  $arFilter = array(
	    'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
	    'ACTIVE' => 'Y',
	    $this->arParams['PROPERTY_TO_DISPLAY_ELEMENTS'] => true,
	  );

	  $rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);

		$counter = 0;

	  while ($arSection = $rsSections->GetNext()) {
	    $result['SECTIONS'][] = $arSection;
			$counter++;

			if ($counter === MAX_COUNT_SECTIONS) {
				break;
			}
	  }
	  unset($arSection, $arSelect, $arFilter, $arOrder, $order, $sort);

	  foreach ($result['SECTIONS'] as &$arSection) {
	    if (!empty($arSection['PICTURE'])) {
	      $arSection['PICTURE'] = CFile::getFileArray($arSection['PICTURE']);
	    }
	  }
	  unset($arSection);
	}

	function executeComponent()
	{
		global $APPLICATION, $USER, $DB;
		if ($this->startResultCache(false, array(($this->arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()))))
		{
			$this->checkIncludeModule();
			$this->checkExistIBlock();
			$this->getResult($this->arResult);

			$arResult = &$this->arResult;
			$arParams = &$this->arParams;

			$this->includeComponentTemplate();
		}
	}
}
