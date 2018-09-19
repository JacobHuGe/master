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
    public $study_id;
    public $num;
    public $title_id;
    
    public function rules()
    {
        return [
            // username and password are both required
            [['title_id', 'name', 'mobile', 'remarks', "study_id", "num"], 'safe'],
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

        $nums = $this->num;
        
        //TODO s数量限制
        foreach($this->study_id as $key => $val){
            if($nums[$key] == 0){
                continue;
            }
            
            $studyEnroll = StudyEnroll::findOne(["title_id" => $_REQUEST["id"], "study_id" => $val, "user_id" => Yii::$app->user->id]);
            if(empty($studyEnroll)){
                
                $studyEnrollModel = new StudyEnroll();
                $studyEnrollModel->title_id = $_REQUEST["id"];
                $studyEnrollModel->study_id = $val;
                $studyEnrollModel->enroll_id = $model->id;
                $studyEnrollModel->num = $nums[$key];
                $studyEnrollModel->user_id = Yii::$app->user->id;
                if($studyEnrollModel->save() === false){
                    throw new BadRequestHttpException("添加报名失败");
                }
                
                $studyEnroll = $studyEnrollModel;
            } else {
                if($nums[$key] == $studyEnroll->num){
                   continue;
                }
                
                $studyEnroll->$nums[$key];
                if($studyEnroll->save() === false){
                    throw new BadRequestHttpException("添加报名修改失败");
                }
            }
        }
        return $enroll;
    }
}
