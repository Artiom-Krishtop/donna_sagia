<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage('C_OCB_NAME_COMPONENT'),
	"DESCRIPTION" => GetMessage('C_OCB_DESCRIPTION'),
  "PATH" => array(
		"ID" => "e-store",
		"CHILD" => array(
			"ID" => "sale_order",
			"NAME" => GetMessage("SOF_NAME")
		)
	),
	"CACHE_PATH" => "Y",
);
?>
