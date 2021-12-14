<?php

namespace Custom\History\Handlers;

use Bitrix\Catalog\PriceTable;
use Bitrix\Catalog\ProductTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

class ChElementHandler extends Handler
{
    public static function onBeforeIBlockElementUpdateHandler(array &$arParams)
    {   
        if (self::checkOption($arParams['IBLOCK_ID'])) {
            self::$arBeforeFields = self::getElementById($arParams['ID'], $arParams['IBLOCK_ID']);
        }
    }
    
   
    public static function onAfterIBlockElementUpdateHandler($arFields)
    {   
        $iblockId = \CIBlockElement::GetIBlockByID($arFields['ID']);

        if (self::checkOption($iblockId)) {

            self::$arAfterFields = self::getElementById($arFields['ID'], $iblockId); 
            
            if (self::compareArray()) {
                self::addInTable($arFields['ID']);
            }
        } 
    }
    
    protected static function getElementById($id, $iblockId)
    {   
        $itemFields = null;

        self::getElementFields($id, $iblockId, $itemFields);
        self::getPropertis($id,$iblockId, $itemFields);
        self::getPrice($id, $itemFields);
        self::getQuantity($id, $itemFields);

        return $itemFields;
    }
    
    protected static function getPrice($id, &$itemFields)
    {
        $price = PriceTable::getList([
            'select' => ['PRICE'],
            'filter' =>['PRODUCT_ID' => $id]
        ]);
        
        while ($a = $price->fetch()) {
  
            $itemFields = array_merge($itemFields, $a);
        }
        unset($price, $a);    
    }

    protected static function getQuantity($id, &$itemFields)
    {
        $quantity = ProductTable::getByPrimary($id, ['select' => ['QUANTITY']]);
        
        while ($a = $quantity->fetch()) {

            $itemFields = array_merge($itemFields, $a);
        }
    }

    protected static function getElementFields($id, $iblockId, &$itemFields)
    {      
        $arFilter = [
            'IBLOCK_ID' => $iblockId,
            'ID' => $id 
        ];

        $arSelect = [
            'IBLOCK_ID',
            'ID',
            'NAME',
            'SORT',     
            'IBLOCK_SECTION_ID',
            'ACTIVE',
            'ACTIVE_FROM',
            'ACTIVE_TO',
            'DATE_ACTIVE_FROM',
            'DATE_ACTIVE_TO',
            'PREVIEW_PICTURE',
            'PREVIEW_TEXT',
            'PREVIEW_TEXT_TYPE',
            'DETAIL_PICTURE',
            'DETAIL_TEXT',
            'DETAIL_TEXT_TYPE',
            'CODE',
            'TAGS',
            'XML_ID',
            'EXTERNAL_ID',
        ];
            
        $item = \CIBlockElement::GetList(array('SORT' => 'ASC'), $arFilter, false, false, $arSelect);
        
        while ($a = $item->fetch()) {
            
            $itemFields = $a;
        }
    } 

    protected static function getPropertis($id, $iblockId, &$itemFields)
    {
        $props = \CIBlockElement::GetPropertyValues($iblockId,['ID' => $id]);
            
        while ($a = $props->fetch()) {
            
            $itemFields['PROPS'] = $a;
        }
    }
}