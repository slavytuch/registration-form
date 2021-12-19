<?php

namespace Project;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\ORM\Fields\IntegerField;

class UserFormTable extends DataManager
{
    public static function getTableName()
    {
        return 'user_form';
    }

    public static function getObjectClass()
    {
        return UserForm::class;
    }

    public static function getMap()
    {
        return [
            new IntegerField(
                'ID', [
                        'primary' => true,
                        'autocomplete' => true,
                    ]
            ),
            new StringField('LAST_NAME', ['required' => true]),
            new StringField('NAME', ['required' => true]),
            new StringField('SECOND_NAME', ['required' => true]),
            new StringField('EMAIL', ['required' => true]),
            new StringField('PHONE', ['required' => true]),
            new StringField('COMPANY', ['required' => true]),
            new StringField('POSITION', ['required' => true]),
            new StringField('SECRET', ['required' => true]),
            new StringField('QR_CODE_FILE_PATH', ['required' => true]),
        ];
    }
}