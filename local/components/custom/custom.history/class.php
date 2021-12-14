<?php

use Custom\History\ORM\HistoryTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class HistotyComponent extends CBitrixComponent
{
   function onPrepareComponentParams($arParams)
   {
      return $arParams;
   }

   function executeComponent()
   {
      $this->getHistory();

      $arResult = $this->arResult;
      $arParams = $this->arParams;
      $this->includeComponentTemplate();
   }

   protected function getHistory()
   {
      $res = HistoryTable::getList(['select' => ['*']]);

      while ($a = $res->fetchAll()) {
         $this->arResult = $a;
      }

      // dd($this->arResult);
   }
}