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

class Title extends ActiveRecord {

    //通过
    const STATE_ADOPT = "adopt";
    //失败
    const STATE_FAIL = "fail";
    //审核中
    const STATE_AUDIT= "audit";
    
    /**
     * 报名状态
     * @return string
     */
    //报名进行中
    const ENROLL_STATE_COMDUCT = 'conduct';
    //报名已终止
    const ENROLL_STATE_STOP = 'stop';
    //报名已删除
    const ENROLL_STATE_DELETED = 'deleted';
    
    public static function tableName() {
        return '{{%title}}';
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

    public function beforeSave($insert) {
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [["content", 'currency', 'log'], "safe"]
        ];
    }
    
    public function getDownload()
    {
        return $this->hasOne(Attachment::className(), ["model_id" => "image_file"]);
    }
    
    public function getStudys()
    {
        return $this->hasMany(Study::className(), ["title_id" => "id"]);
    }
    
    /**
     * 报名数量
     * @param type $titleId
     * @param type $studyId
     * @return type
     */
    public function enrollNum($titleId, $studyId){
        $enrolls = StudyEnroll::find()->andWhere(["title_id" => $titleId, "study_id" => $studyId])->asArray()->all();
        $num = 0;
        foreach($enrolls as $enroll){
            $num = $enroll["num"] + $num;
        }
        return $num;
    }
    
    public function surplusNum($titleId, $studyId){
        $enrollNum = $this->enrollNum($titleId, $studyId);
        
        $num = Study::findOne(["id" => $studyId]);
        return $num->number - $enrollNum;
    }
    
    
    
}
