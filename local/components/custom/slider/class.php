<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @var array $this->arParams */
/** @var array $this->arResult */

use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Iblock;

class SliderElement extends CBitrixComponent
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
			'filter' => array('=IBLOCK_ID' => $this->arParams['IBLOCK_ID'], '=SITE_ID' => SITE_ID, '=IBLOCK.ACTIVE' => 'Y')
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
	    'DETAIL_PICTURE',
	    $this->arParams['PROPERTY_TO_DISPLAY_ELEMENTS']
	  );

	  $arFilter = array(
	    'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
	    'ACTIVE' => 'Y',
	    $this->arParams['PROPERTY_TO_DISPLAY_ELEMENTS'] => true,
	  );

	  $rsSections = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
	  while ($arSection = $rsSections->GetNext()) {
	    $result['ELEMENTS'][] = $arSection;
	  }
	  unset($arSection, $arSelect, $arFilter, $arOrder, $order, $sort);

	  foreach ($result['ELEMENTS'] as &$arSection) {
	    if (!empty($arSection['DETAIL_PICTURE'])) {
	      $arSection['DETAIL_PICTURE'] = CFile::getFileArray($arSection['DETAIL_PICTURE']);
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
