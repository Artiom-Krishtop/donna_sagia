<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arTemplateParameters["MI_ADD_BUTTON"] = array(
  "PARENT" => "ADDITIONAL_SETTINGS",
  "NAME" => GetMessage("MI_ADD_BUTTON"),
  "TYPE" => "CHECKBOX",
  "REFRESH" => "Y"
);

if ($arCurrentValues['MI_ADD_BUTTON'] === 'Y') {
  $arTemplateParameters["MI_NAME_BUTTON"] = array(
    "PARENT" => "ADDITIONAL_SETTINGS",
    "NAME" => GetMessage("MI_NAME_BUTTON"),
    "TYPE" => "STRING",
  );

  $arTemplateParameters["MI_LINK_BUTTON"] = array(
    "PARENT" => "ADDITIONAL_SETTINGS",
    "NAME" => GetMessage("MI_LINK_BUTTON"),
    "TYPE" => "STRING",
  );
}
