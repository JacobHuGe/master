<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Description extends ActiveRecord {
    
    public static function tableName() {
        return '{{%description}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                "class" => TimestampBehavior::className()
            ]
        ];
    }
    
    public function beforeSave($insert) {
        return parent::beforeSave($insert);
    }
}