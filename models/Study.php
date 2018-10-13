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
    
    public function getStudyEnroll(){
        return $this->hasOne(StudyEnroll::className(), ["study_id" => "id"]);
    }
    
    public function getStudyEnrolls(){
        return $this->hasMany(StudyEnroll::className(), ["study_id" => "id"]);
    }
    
    public static function accumulativeNumber($id){
        $study = Study::findOne(["id" => $id]);
        $num = 0;
        foreach($study->studyEnrolls as $studyEnroll){
            $num = $num + $studyEnroll->num;
        }
        return $num;
    }
    
        public static function accumulativePrice($id){
        $study = Study::findOne(["id" => $id]);
        $num = 0;
        foreach($study->studyEnrolls as $studyEnroll){
            $num = $num + $studyEnroll->num * $study->price;
        }
        return $num;
    }
    
}
    