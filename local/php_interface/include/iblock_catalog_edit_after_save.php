<?php

use Bitrix\Main\Loader;
use Custom\History\Handlers\ChElementHandler;

if (!function_exists('BXIBlockAfterSave')) {
   function BXIBlockAfterSave($arFields)
   { 
      if (Loader::includeModule('custom.history')) {
         ChElementHandler::onAfterIBlockElementUpdateHandler($arFields);
      }
   }
}
