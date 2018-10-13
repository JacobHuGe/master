<?php

namespace app\models\site;

use app\models\Attachment;
use app\models\Study;
use app\models\Title;
use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TitleUpdateForm extends Model {

    public $name;
    public $content;
    public $currency;
    public $imageFile;
    public $studys;
    public $end_at;
    public $is_show_name;
    public $is_show_phone;
    public $is_show_leave;
    public $describe;
    
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['imageFile'], 'file', 'skipOnEmpty' => false],
            [['name', "content", 'imageFile'], 'required'],
            [['currency', 'end_at', 'is_show_name', 'is_show_phone', 'is_show_leave', "describe"], "safe"],
            //[['describe'],'match','pattern'=>'','message'=>'提示信息']
        ];
    }
    /**
     * 映射方法
     * @return type
     */
    public function attributeLabels()
    {
        return [
            "name" => Yii::t('app',"标题"),
            "content" => Yii::t('app', "描述"),
            "number" => Yii::t('app', "数量限制"),
        ];
    }

    public function save() {
        
        if (!$this->validate()) {
            throw new BadRequestHttpException($this);
        }
        
        $id = $_REQUEST["id"];
        
        $model = Title::findOne(["id" => $id, "deleted_at" => 0]);
        if(empty($model)){
            throw new BadRequestHttpException(Yii::t("app", "标题已被删除或不存在"));
        }
        
        $is_show_name = 0;
        $is_show_phone = 0;
        $is_show_leave = 0;

        if(!empty($this->is_show_name)){
            $is_show_name = 1;
        }
        if(!empty($this->is_show_phone)){
            $is_show_phone = 1;
        }
        if(!empty($this->is_show_leave)){
            $is_show_leave = 1;
        }
        
        $end_at = 0;
        
        if(!empty($this->end_at)){
            $endAt = $this->end_at;
            $match = "/^(\d{4})(-)(\d{2})(-)(\d{2})$/";
            if(!preg_match($match, $endAt)){
                throw new BadRequestHttpException(Yii::t("app", " 结束时间不符合规则"));
            }
            
            $end_at = strtotime($endAt);
            
            if($end_at < time()){
                throw new BadRequestHttpException(Yii::t("app", " 结束时间不能小于当前时间"));
            }
        }

        $model->currency = $this->currency;
        $model->end_at = $end_at;
        $model->is_show_name = $is_show_name;
        $model->is_show_phone = $is_show_phone;
        $model->is_show_leave = $is_show_leave;
        
        if($model->save() === false){
            throw new BadRequestHttpException(Yii::t("app", $model));
        }
        
        if(!empty($this->describe)){
            $description = new \app\models\Description();
            $description->content = $this->describe;
            $description->created_by = Yii::$app->user->id;
            $description->title_id = $id;
            if($description->save() === false){
                throw new BadRequestHttpException(Yii::t("app", " 添加描述信息失败"));
            }
        }

        if(!empty($this->imageFile)){
            foreach($this->imageFile as $imageFileUrl){
                $attachmentIn = Attachment::findOne(["model_id" => $model, "img_url" => $imageFileUrl, "deleted_at" => 0]);
                if(empty($attachmentIn)){
                    $attachment = new Attachment();
                    $attachment->owner_id = Yii::$app->user->id;
                    $attachment->img_url = $imageFileUrl;
                    $attachment->model_id = $model->id;
                    if($attachment->save() === false){
                        throw new BadRequestHttpException(Yii::t("app", $attachment));
                    }
                }
            }
        }
        
        
        return "ok";
        
    }

}
