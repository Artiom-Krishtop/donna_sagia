<?php

namespace Custom\History\ORM;

use Bitrix\Main\Entity,
    Bitrix\Main\Type;

class CreateItemHistoryTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'custom_create_item_history';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true,
            )),
            new Entity\DateField('DATE_EDIT', array(
                'required' => true,
                'default_value' => new Type\Date(),
            )),
            new Entity\StringField('NAME_EDITOR', array(
                'required' => true,
            )),
            new Entity\IntegerField('ITEM_ID',array(
                'required' => true,
            )),
            new Entity\TextField('VALUE_FIELDS_BEFORE', array(
                'required' => true,
            )),
            new Entity\TextField('VALUE_FIELDS_AFTER', array(
                'required' => true,
            )),
        );
    }
}
