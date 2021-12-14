<?php

namespace Custom\History\Tabs;

class TabHistory
{
   public function init()
   {
      return [
         'TABSET' => 'HISTORY',
         'GetTabs' => [__CLASS__, 'GetTabs'],
         'ShowTab' => [__CLASS__, 'ShowTab'],
         'Action' => [__CLASS__, 'Action'],
         'Check' => [__CLASS__, 'Check']
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
      $arTabs = ['DIV' => 'create_history_tabs', 'TAB' => 'История', 'TITLE' => 'История изменения элемента'];
      
      return $arTabs;
   }
   
   function ShowTab($divName, $arArgs, $bVarsFromForm)
   {
      dd('include');
      if ($divName == "create_history_tabs")
      {
        ?>
        <tr>
          <td width="40%">Собственное поле 1:</td>
          <td width="60%"><input type="text" name="custom_field_1"></td>
        </tr>
        <?
      }
   }



}