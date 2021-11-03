<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arCurrentValues */

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock'))
	return;

$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

if ($iblockExists)
{
	$rsProps = CIBlockProperty::GetList(
		array('SORT' => 'ASC', 'ID' => 'ASC'),
		array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], 'ACTIVE' => 'Y')
	);
	while ($arProp = $rsProps->Fetch())
	{
		$strPropName = '['.$arProp['ID'].']'.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];


		if ('L' == $arProp['PROPERTY_TYPE'])
		{
			$arListPropList[$arProp['CODE']] = $strPropName;
		}
	}

  $arTemplateParameters['LABEL_PROP'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => GetMessage('CP_BC_TPL_LABEL_PROP'),
    'TYPE' => 'LIST',
    'MULTIPLE' => 'Y',
    'ADDITIONAL_VALUES' => 'N',
    'REFRESH' => 'Y',
    'VALUES' => $arListPropList
  );
}
