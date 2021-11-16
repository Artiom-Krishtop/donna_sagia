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
  $arProperty_UF = array();

  $arUserFields = $USER_FIELD_MANAGER->GetUserFields("IBLOCK_".$arCurrentValues["IBLOCK_ID"]."_SECTION", 0, LANGUAGE_ID);

  foreach($arUserFields as $FIELD_NAME=>$arUserField)
  {
  	$arUserField['LIST_COLUMN_LABEL'] = (string)$arUserField['LIST_COLUMN_LABEL'];

    if ($arUserField['USER_TYPE_ID'] === 'boolean') {
      $arProperty_UF[$FIELD_NAME] = $arUserField['LIST_COLUMN_LABEL'] ? '['.$FIELD_NAME.']'.$arUserField['LIST_COLUMN_LABEL'] : $FIELD_NAME;
    }
  }

  $arSort = CIBlockParameters::GetSectionSortFields(array('SORT', 'NAME', 'TIMESTAMP_X'));
  $arOrder = array("asc" => GetMessage("TSL_ASC"),"desc" => GetMessage("TSL_DESC"));
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
    "PROPERTY_TO_DISPLAY_ELEMENTS" => array(
      "PARENT" => "VISUAL",
      "NAME" => GetMessage("TSL_PROPERTY_TO_DISPLAY_SECTIONS"),
      "TYPE" => "LIST",
      "ADDITIONAL_VALUES" => "Y",
      "VALUES" => $arProperty_UF
    ),
    "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("TSL_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
    "SECTION_SORT_FIELDS" => array(
      "PARENT" => "VISUAL",
      "NAME" => GetMessage("TSL_SECTION_SORT_FIELDS"),
      "TYPE" => "LIST",
      "VALUES" => $arSort,
      "DEFAULT" => "SORT"
    ),
    "SECTION_SORT_ORDER" => array(
      "PARENT" => "VISUAL",
      "NAME" => GetMessage("TSL_SORT_ORDER"),
      "TYPE" => "LIST",
      "VALUES" => $arOrder,
      "DEFAULT" => "asc",
    ),
  )
);
