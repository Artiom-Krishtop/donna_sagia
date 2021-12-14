<?php

namespace Custom\History\Handlers;

use Bitrix\Catalog\Model\Event;
use Bitrix\Catalog\PriceTable;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use CIBlockElement;

class ChPriceHandler extends Handler
{
   public static function onBeforePriceUpdateHandler(Event $e)
   {
      $priceId = $e->getParameter('id');
      $arFields = $e->getParameter('fields');

      $iBlockId = self::getIblockId($arFields['PRODUCT_ID']);

      if (self::checkOption($iBlockId)) {
         $item = PriceTable::getByPrimary($priceId);
   
         while ($a = $item->fetch()) {
            self::$arBeforeFields = $a;
         }
      }

   }
   
   public static function onAfterPriceUpdateHandler(Event $e)
   {
      $priceId = $e->getParameter('id');
      $result = $e->getParameter('success');
      $arFields = $e->getParameter('fields');

      $iBlockId = self::getIblockId($arFields['PRODUCT_ID']);
      
      if (self::checkOption($iBlockId)) {
         
         $item = PriceTable::getByPrimary($priceId);
         
         while ($a = $item->fetch()) {
            self::$arAfterFields = $a;
         }
         
         if(self::compareArray($result)){
            self::addInTable($arFields['PRODUCT_ID']);
         }
      }
   }
   
   protected static function getIblockId($productId)
   {
      if (Loader::includeModule('iblock')) {
         $iBlockId = CIBlockElement::GetIBlockByID($productId);

         return $iBlockId;
      }

      return null;
   }
}