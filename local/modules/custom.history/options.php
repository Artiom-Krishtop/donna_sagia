<?php

use Bitrix\Iblock\IblockTable;
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
    </select><br>
    <label for="edit-file-before-path"><?=GetMessage('CH_EDIT_FILE_BEFORE')?></label>
    <input type="text" name="edit-file-before-path"><br>
    <input type="submit" name="save" value='<?=GetMessage('FORM_SAVE')?>'>
</form>

<?
if (isset($_REQUEST['iblock-list'])) {
    $iblock_id = intval($_REQUEST['iblock-list']);

    $old_iblock_id = Option::get('custom.history', 'iblock_id');

    if (isset($old_iblock_id) && $old_iblock_id != $iblock_id) {
        $arFilter = [
            'fields' => ['EDIT_FILE_BEFORE' => ''],
        ];
    
        IblockTable::update($old_iblock_id, $arFilter);
    }

    Option::set('custom.history', 'iblock_id',$iblock_id);

    $editFileBeforePath = !empty($_REQUEST['edit-file-before-path']) ? $_REQUEST['edit-file-before-path'] : '/local/php_interface/include/iblock_catalog_edit_after_save.php';

    $arFilter = [
        'fields' => ['EDIT_FILE_BEFORE' => $editFileBeforePath],
    ];

    IblockTable::update($iblock_id, $arFilter);

    unset($iblock_id);
}
?>


