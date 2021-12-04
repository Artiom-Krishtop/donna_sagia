<?php

namespace Custom\History\Handlers;

use Bitrix\Main\Loader;
use Custom\History\ORM\CreateItemHistoryTable;

class IBlockEventHandler
{
    protected static $arBeforeFields = array();
    protected static $arBeforeFieldsValueDB = array();
    protected static $arAfterFieldsValueDB = array();

    public static function onBeforeIBlockElementUpdateHundler(array &$arParams)
    {   
        if(Loader::includeModule('iblock')){
            
            // $item = \CIBlockElement::GetById($arParams['ID']);
            $arFilter = array(
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'ID' => $arParams['ID'],
            );
            
            $arSelect = array();
            $arSelect = array_keys($arParams);   
            
            $item = \CIBlockElement::GetList(array('SORT' => 'ASC'), $arFilter, false, false, $arSelect);
            
            while ($a = $item->fetch()) {
                
                self::$arBeforeFields = $a;

                // if (Loader::includeModule('main')) {
                //     if(isset($a['PREVIEW_PICTURE'])){

                //         self::$arBeforeFields['PREVIEW_PICTURE'] = \CFIle::MakeFileArray($a['PREVIEW_PICTURE']);   
                //     }

                //     if(isset($a['DETAIL_PICTURE'])){

                //         self::$arBeforeFields['DETAIL_PICTURE'] = \CFIle::MakeFileArray($a['DETAIL_PICTURE']);
                //     }
                // }
                
            }
            unset($item, $a);
            
        }
        
    }
    
    protected static function compareArray($arFields)
    {
        foreach ($arFields as $key => $value) {
            // echo $arFields[$key];
            // echo '<br>';
            // echo self::$arBeforeFields[$key];
            // echo '-----------------------------------------<br>';
            if ($key === 'DETAIL_PICTURE') {
                continue;
            }

            if (array_key_exists($key, self::$arBeforeFields) && $arFields[$key] != self::$arBeforeFields[$key]) {
                echo '+';
                self::$arBeforeFieldsValueDB[$key] = self::$arBeforeFields[$key];
                self::$arAfterFieldsValueDB[$key] = $arFields[$key];
            }
        }
        echo '<pre>' . print_r(self::$arBeforeFieldsValueDB, 1) . '</pre>';
        die(); 
        
    }
    public static function onAfterIBlockElementUpdateHandler(array &$arFields)
    {        
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