<?php
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StudyEnroll extends ActiveRecord
{
    
    public static function tableName() {
        return '{{%study_enroll}}';
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
    
    public function getStudy(){
        return $this->hasOne(Study::className(), ["id" => "study_id"]);
    }
    
    public function getTitle(){
        return $this->hasOne(Title::className(), ["id" => "title_id"]);
    }
    
    public function getEnroll(){
        return $this->hasOne(Enroll::className(), ["id" => "enroll_id"]);
    }
    
    public static function enrollNum($title_id, $study_id){
        $enroll = StudyEnroll::findOne(["title_id" => $title_id,"study_id" => $study_id, "user_id" => Yii::$app->user->id]);
        
        if(!empty($enroll)){
            return $enroll->num;
        } else {
            return 0;
        }
    }
}