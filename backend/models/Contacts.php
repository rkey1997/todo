<?php

namespace app\models;

use yii\db\ActiveRecord;

class Contacts extends ActiveRecord
{
    public static function tableName() {
        return 'contacts';
    }

}
