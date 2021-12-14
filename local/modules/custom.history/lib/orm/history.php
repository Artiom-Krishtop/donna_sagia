<?php

namespace Custom\History\ORM;

use Bitrix\Main\Entity,
    Bitrix\Main\Type;
use Bitrix\Main\Entity\Query\Join;
use Bitrix\Main\UserTable;

class HistoryTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'custom_create_item_history';
    }

    public static function getMap()
    {
        return array(
            (new Entity\IntegerField('ID'))
                ->configurePrimary()
                ->configureAutocomplete(),

            (new Entity\DateField('DATE_EDIT'))
                ->configureRequired()
                ->configureDefaultValue(new Type\Date()),
        
            (new Entity\IntegerField('USER_ID'))
                ->configureRequired(),

            (new Entity\ReferenceField('USER', UserTable::class, Join::on('this.USER_ID', 'ref.ID')))
                ->configureJoinType('inner'),

            (new Entity\IntegerField('ITEM_ID'))
                ->configureRequired(),

            (new Entity\TextField('VALUE_FIELDS_BEFORE'))
                ->configureSerialized()
                ->configureRequired(),
            
            (new Entity\TextField('VALUE_FIELDS_AFTER'))
                ->configureSerialized()
                ->configureRequired(),
        );
    }
}

