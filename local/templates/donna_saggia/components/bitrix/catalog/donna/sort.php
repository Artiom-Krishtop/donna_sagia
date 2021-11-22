<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if ($_GET["sort"] === 'SCALED_PRICE_1' || $_GET['sort'] === 'active_from') {
	$sortField = $_GET['sort'];
}else {
	$sortField = $arParams["ELEMENT_SORT_FIELD"];
}

if ($_GET['order'] === 'asc' || $_GET['order'] === 'desc') {
	$order = $_GET['order'];
}else {
	$order = $arParams["ELEMENT_SORT_ORDER"];
}
