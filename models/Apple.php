<?php

namespace app\models;

use yii\db\ActiveRecord;

class Apple extends ActiveRecord
{
    public static function tableName(){
        return "apples";
    }
}