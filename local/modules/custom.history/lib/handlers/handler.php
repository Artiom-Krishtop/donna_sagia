<?php

namespace Custom\History\Handlers;

use Bitrix\Main\Loader;
use Custom\History\ORM\HistoryTable;
use Bitrix\Main\Config\Option;

abstract class Handler
{
   protected static $arBeforeFields = array();
   protected static $arAfterFields = array();
   protected static $arBeforeFieldsValueDB = array();
   protected static $arAfterFieldsValueDB = array();

   protected static function compareArray($result = true)
   {
       if ($result === true) {
           foreach (self::$arAfterFields as $key => $value) {

                if (is_array($value)) {
                    foreach ($value as $code => $val) {
                        if (array_key_exists($key, self::$arBeforeFields) && self::$arAfterFields[$key][$code] != self::$arBeforeFields[$key][$code]) {
                    
                            self::$arBeforeFieldsValueDB[$key][$code] = self::$arBeforeFields[$key][$code];
                            self::$arAfterFieldsValueDB[$key][$code] = self::$arAfterFields[$key][$code];
                        }     
                    }
                    continue;
                }
                
               if (array_key_exists($key, self::$arBeforeFields) && self::$arAfterFields[$key] != self::$arBeforeFields[$key]) {
                   
                   self::$arBeforeFieldsValueDB[$key] = self::$arBeforeFields[$key];
                   self::$arAfterFieldsValueDB[$key] = self::$arAfterFields[$key];
               }
           }
        }  
        
        if (!empty(self::$arAfterFieldsValueDB) && !empty(self::$arBeforeFieldsValueDB)) {
            return true;
        }

        return false;
    }
    
    protected static function addInTable($id)
    {
        global $USER;

        $result = HistoryTable::add(array(
            'USER_ID' => $USER->GetId(),
            'ITEM_ID' => intval($id),
            'VALUE_FIELDS_AFTER' => self::$arAfterFieldsValueDB,
            'VALUE_FIELDS_BEFORE' => self::$arBeforeFieldsValueDB,
        ));

        if (!$result->isSuccess()) {
            
            echo 'Ошибка добавления елемента';

            return false;
        }
        
        return true;
    }

    protected static function checkOption($iBlockId)
    {
        $iblock_id = Option::get('custom.history', 'iblock_id');

        if ($iBlockId == $iblock_id && $iblock_id !== '') {
            return true;
        }
        
        return false;
    }
}