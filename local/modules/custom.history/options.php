<?php

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

$arIBlock = array();


$obIBlock = CIBlock::GetList(array('SORT' => 'ASC'));

while ($a = $obIBlock->GetNext()) {
    $arIBlock[$a['ID']] = '['.$a['ID'].']'.$a['NAME'];
}
unset($obIBlock, $a);

?>
<form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($mid)?>&lang=<?=LANGUAGE_ID?>">
    <label for="iblock-list"><?=GetMessage('CH_OPTION_IBLOCK_SELECT')?></label>
    <select name="iblock-list" >
        <?foreach ($arIBlock as $key => $value):?>
            <option value="<?=$key?>"><?=$value?></option>
        <?endforeach;?>
    </select>
    <input type="submit" name="save" value='<?=GetMessage('FORM_SAVE')?>'>
</form>

<?
if (isset($_REQUEST['iblock-list'])) {
    $iblock_id = intval($_REQUEST['iblock-list']);
    
    Option::set('custom.history', 'iblock_id',$iblock_id);

    unset($iblock_id);
}
?>


