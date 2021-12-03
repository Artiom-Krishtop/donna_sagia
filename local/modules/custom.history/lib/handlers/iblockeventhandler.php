<?php

namespace Custom\History\Handlers;

use Bitrix\Main\Loader;
use Custom\History\ORM\CreateItemHistoryTable;

class IBlockEventHandler
{
    protected static $arBeforeFields;
    protected static $arBeforeFieldsValueDB;
    protected static $arAfterFieldsValueDB;

    public static function onBeforeIBlockElementUpdateHundler(array &$arParams)
    {
        if(!(Loader::includeModule('iblock'))){
            return;
        }

    }
    
    protected static function compareArray($arFields)
    {
        foreach ($arFields as $key => $value) {
            if ($arFields[$key] !== self::$arBeforeFields[$key]) {
                self::$arBeforeFieldsValueDB[$key] = self::$arBeforeFields[$key];
                self::$arAfterFieldsValueDB[$key] = $arFields[$key];
            }
        }
        
    }
    public static function onAfterIBlockElementUpdateHandler(array &$arFields)
    {        
        echo '<pre>' . print_r($arFields, 1) . '</pre>';
        die(); 
        self::compareArray($arFields);
        
        if ($arFields['RESULT'] === true) {

            $result = CreateItemHistoryTable::add(array(
                'NAME_EDITOR' => 'ARTIOM',
                'ITEM_ID' => intval($arFields['ID']),
                'VALUE_FIELDS_AFTER' => self::$arAfterFieldsValueDB,
                'VALUE_FIELDS_BEFORE' => self::$arBeforeFieldsValueDB,
            ));
        }
    }
}