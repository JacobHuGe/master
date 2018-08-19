<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ApplyForm extends Model{
    public $name;
    public $mobile;
    public $remarks;
    public $study_id;
    public $num;
    
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'mobile', 'remarks', "study_id", "num"], 'safe'],
        ];
    }
    
    public function save(){
        if(!$this->validate()){
            return false;
        }
        
        $model = new Enroll();
        $model->name = $this->name;
        $model->mobile = $this->mobile;
        $model->remarks = $this->remarks;
        $model->user_id = Yii::$app->user->id;
        if($model->save() === false){
            throw new \yii\web\BadRequestHttpException("报名失败");
        }
        //var_Dump($this->id);die;

        $nums = $this->num;
        
        foreach($this->study_id as $key => $val){
            if($nums[$key] == 0){
                continue;
            }
            $studyEnroll = new StudyEnroll();
            $studyEnroll->title_id = $_REQUEST["id"];
            $studyEnroll->study_id = $val;
            $studyEnroll->enroll_id = $model->id;
            $studyEnroll->num = $nums[$key];
            $studyEnroll->user_id = Yii::$app->user->id;
            if($studyEnroll->save() === false){
                throw new \yii\web\BadRequestHttpException("添加报名失败");
            }
        }
        return $model;
    }
}
