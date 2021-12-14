<?php

namespace Custom\History\Tabs;

class TabHistory
{
   public function OnInit()
   {
      return [
         'TABSET' => 'history',
         'Action' => [__CLASS__, 'Action'],
         'Check' => [__CLASS__, 'Check'],
         'GetTabs' => [__CLASS__, 'GetTabs'],
         'ShowTab' => [__CLASS__, 'ShowTab'],
      ];
   }
   
   function Action($arArgs)
   {
      return true;
   }
   
   function Check($arArgs)
   {
      return true;
   }
   
   function GetTabs($arArgs)
   {
      
      $arTabs = [['DIV' => 'create_history_tabs', 'TAB' => 'История', 'TITLE' => 'История изменения элемента']];
      
      return $arTabs;
   }
   
   function ShowTab($divName, $arArgs, $bVarsFromForm)
   {
      global $APPLICATION;

      $APPLICATION->IncludeComponent(
         'custom:custom.history',
         '',
         []
      );
   }



}