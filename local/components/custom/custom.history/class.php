<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class HistotyComponent extends CBitrixComponent
{
   function onPrepareComponentParams($arParams)
   {
      return $arParams;
   }

   function executeComponent()
   {
      $this->includeComponentTemplate();
   }
}