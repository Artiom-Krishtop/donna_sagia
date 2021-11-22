<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

use Bitrix\Main\Loader,
  Bitrix\Iblock;

global $USER_FIELD_MANAGER;

if (!Loader::includeModule('iblock')) {
  return;
}

$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$iblockFilter = (
	!empty($arCurrentValues['IBLOCK_TYPE'])
	? array('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
	: array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch())
{
	$id = (int)$arr['ID'];
	if (isset($offersIblock[$id]))
		continue;
	$arIBlock[$id] = '['.$id.'] '.$arr['NAME'];
}
unset($id, $arr, $rsIBlock, $iblockFilter);
unset($offersIblock);


if ($iblockExists) {
  $arSort = CIBlockParameters::GetElementSortFields(array('SORT', 'NAME', 'TIMESTAMP_X'));
  $arOrder = array("asc" => GetMessage("C_S_ASC"),"desc" => GetMessage("C_S_DESC"));
}

$arComponentParameters = array(
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock ,
			"REFRESH" => "Y",
		),
    "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("C_S_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
    "SECTION_SORT_FIELDS" => array(
      "PARENT" => "VISUAL",
      "NAME" => GetMessage("C_S_SECTION_SORT_FIELDS"),
      "TYPE" => "LIST",
      "VALUES" => $arSort,
      "DEFAULT" => "SORT"
    ),
    "SECTION_SORT_ORDER" => array(
      "PARENT" => "VISUAL",
      "NAME" => GetMessage("C_S_SORT_ORDER"),
      "TYPE" => "LIST",
      "VALUES" => $arOrder,
      "DEFAULT" => "asc",
    ),
  )
);
