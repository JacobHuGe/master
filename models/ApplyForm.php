<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;

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
    public $title_id;
    public $hiddenInput;
    
    public function rules()
    {
        return [
            // username and password are both required
            [['title_id', 'name', 'mobile', 'remarks', "hiddenInput"], 'safe'],
        ];
    }
    
    public function save(){
        if(!$this->validate()){
            return false;
        }

        $enroll = Enroll::findOne(["title_id" => $this->title_id, "user_id" => Yii::$app->user->id]);
        
        if(empty($enroll)){
            $model = new Enroll();
            $model->name = $this->name;
            $model->mobile = $this->mobile;
            $model->remarks = $this->remarks;
            $model->user_id = Yii::$app->user->id;
            $model->title_id = $this->title_id;
            if($model->save() === false){
                throw new BadRequestHttpException("报名失败");
            }
            $enroll = $model;
        }
        if(empty($this->hiddenInput)){
            throw new BadRequestHttpException("请选择报名项");
        }
        $hiddenInput = substr($this->hiddenInput, 0, -1);
        $enrollInfos = explode(',',$hiddenInput);
        foreach($enrollInfos as $enrollInfo){
            $enrollStudyInfo = explode('=',$enrollInfo);
            
            $studyEnroll = StudyEnroll::findOne(["title_id" => $enroll->title_id, "study_id" => $enrollStudyInfo[0], "enroll_id" => $enroll->id, "user_id" => Yii::$app->user->id]);
            if(empty($studyEnroll)){
                $studyEnrollModel = new StudyEnroll();
                $studyEnrollModel->title_id = $enroll->title_id;
                $studyEnrollModel->study_id = $enrollStudyInfo[0];
                $studyEnrollModel->enroll_id = $enroll->id;
                $studyEnrollModel->num = $enrollStudyInfo[1];
                $studyEnrollModel->user_id = Yii::$app->user->id;
                if($studyEnrollModel->save() === false){
                    throw new BadRequestHttpException("添加报名失败");
                }
                
                $studyEnroll = $studyEnrollModel;
            } else {
                if($enrollStudyInfo[1] == $studyEnroll->num){
                   continue;
                }
                
                $studyEnroll->num = $enrollStudyInfo[1];
                if($studyEnroll->save() === false){
                    throw new BadRequestHttpException("添加报名修改失败");
                }
            }
        }
        return $enroll;
    }
}
