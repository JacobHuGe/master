<?php

namespace app\models;

use app\behaviors\UniqueIdGenerator;
use app\helpers\FileHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Enroll extends ActiveRecord {
    
    public static function tableName() {
        return '{{%enroll}}';
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
    
    public function getTitle(){
        return $this->hasOne(Title::className(), ["id" => "title_id"]);
    }
    
    /**
     * @inheritdoc
     */
//    public function rules() {
//        return [
//            [['name'], 'required'],
//            [["content", 'currency', 'log'], "safe"]
//        ];
//    }
}