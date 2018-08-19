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

class CreateForm extends Model {

    public $name;
    public $content;
    public $currency;
    public $imageFile;
    public $study_name;
    public $end_at;
    public $price;
    public $number;
    public $is_show_name;
    public $is_show_phone;
    public $is_show_leave;
    

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['imageFile'], 'file', 'skipOnEmpty' => false],
            [['name', "study_name", "content", 'price'], 'required'],
            [['currency', 'end_at', 'number', 'is_show_name', 'is_show_phone', 'is_show_leave'], "safe"],
        ];
    }
    

    public function save() {
        if (!$this->validate()) {
            throw new BadRequestHttpException($this);
        }
        
        //$imgMd5Name = md5(time());
        //$imgUrl = '/uploads/' . $imgMd5Name . '.' . $this->imageFile->extension;

        //$this->imageFile->saveAs(dirname(dirname(__DIR__)).'/web'.$imgUrl); 
        
        $is_show_name = 0;
        $is_show_phone = 0;
        $is_show_leave = 0;
        

        if($this->is_show_name == 'is_show_name'){
            $is_show_name = 1;
        }
        if($this->is_show_phone == 'is_show_phone'){
            $is_show_phone = 1;
        }
        if($this->is_show_leave == 'is_show_leave'){
            $is_show_leave = 1;
        }
        
        
        $model = new Title();
        $model->name = $this->name;
        $model->currency = $this->currency;
        $model->content = $this->content;
        $model->end_at = $this->end_at;
        $model->is_show_name = $is_show_name;
        $model->is_show_phone = $is_show_phone;
        $model->is_show_leave = $is_show_leave;
        //$model->image_file = $imgMd5Name;
        $model->enroll_state = Title::ENROLL_STATE_COMDUCT;
        $model->state = Title::STATE_ADOPT;
        $model->created_by = Yii::$app->user->id;
        if($model->save() === false){
            throw new BadRequestHttpException(Yii::t("app", $model));
        }
        
        $num = count($this->study_name);
        for($i=0; $i<=$num-1; $i++){
            $study = new Study();
            
            $study->name = $this->study_name[$i];
            $study->price = $this->price[$i];
            $study->number = $this->number[$i];
            
            $study->title_id = $model->id;
            if($study->save() === false){
                throw new BadRequestHttpException(Yii::t("app", $study));
            }
        }
        
//        $attachment = new Attachment();
//        $attachment->owner_id = $model->id;
//        $attachment->model_id = $imgMd5Name;
//        $attachment->img_url = $imgUrl;
//        if($attachment->save() === false){
//            throw new BadRequestHttpException(Yii::t("app", $attachment));
//        }
        
        return "ok";
        
    }

}
