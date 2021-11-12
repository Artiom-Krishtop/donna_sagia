<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section>
			 <?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		Array(
			"AREA_FILE_RECURSIVE" => "Y",
			"AREA_FILE_SHOW" => "file",
			"COMPONENT_TEMPLATE" => ".default",
			"EDIT_TEMPLATE" => "standard.php",
			"PATH" => "include/slides.php"
		)
	);?>
	
		<?$APPLICATION->IncludeComponent(
			 "bitrix:main.include",
			 ".default",
			 Array(
				 "AREA_FILE_RECURSIVE" => "Y",
				 "AREA_FILE_SHOW" => "file",
				 "COMPONENT_TEMPLATE" => ".default",
				 "EDIT_TEMPLATE" => "standard.php",
				 "PATH" => "include/advertising.php"
			 )
			);?>

</section>
