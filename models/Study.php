<?php

namespace app\models;

use app\behaviors\UniqueIdGenerator;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Study extends ActiveRecord {

    public static function tableName() {
        return '{{%study}}';
    }

    public function beforeSave($insert) {
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                "class" => UniqueIdGenerator::className()
            ],
            [
                "class" => TimestampBehavior::className()
            ]
        ];
    }
}
    
    
    
    