<?php

namespace app\models;

use yii\db\ActiveRecord;

class CustomUser extends ActiveRecord
{
    public static function tableName(){
        return "users";
    }   
}