<?php
namespace app\models;

use yii\db\ActiveRecord;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StudyEnroll extends ActiveRecord
{
    public $title_id;
    public $study_id;
    public $enroll_id;
    public $num;
    
    public static function tableName() {
        return '{{%study_enroll}}';
    }
    
    public function rules()
    {
        return [
            // username and password are both required
            [['title_id', 'study_id', 'enroll_id', "num"], 'required'],
        ];
    }

    public function beforeSave($insert) {
        return parent::beforeSave($insert);
    }
    
    
}