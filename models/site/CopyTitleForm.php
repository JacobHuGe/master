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
class CopyTitleForm extends Model {
    public $name;
    public $content;
    public $currency;
    public $imageFile;
    public $study;
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
        
        $isTitleName = Title::findOne(["name" => $this->name, "deleted_at" => 0]);
        if(!empty($isTitleName)){
            throw new BadRequestHttpException(Yii::t("app", "名称已存在"));
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
        
        $model = new Title();
        $model->name = $this->name;
        $model->currency = $this->currency;
        $model->content = $this->content;
        $model->end_at = $end_at;
        $model->is_show_name = $is_show_name;
        $model->is_show_phone = $is_show_phone;
        $model->is_show_leave = $is_show_leave;
        $model->enroll_state = Title::ENROLL_STATE_COMDUCT;
        $model->state = Title::STATE_ADOPT;
        $model->created_by = Yii::$app->user->id;
        if($model->save() === false){
            throw new BadRequestHttpException(Yii::t("app", $model));
        }
        
        if(!empty($_REQUEST["Study"])){
            $study = new Study();
            $study->name = $_REQUEST["Study"]["name"];
            $study->price = $_REQUEST["Study"]["price"];
            $study->number = $_REQUEST["Study"]["number"];
            $study->title_id = $model->id;
            if($study->save() === false){
                throw new BadRequestHttpException(Yii::t("app", $study));
            }
        } else{
            throw new BadRequestHttpException(Yii::t("app", "请添加项目"));
        }
        
        
        if(!empty($this->imageFile)){
            foreach($this->imageFile as $imageFileUrl){
                $attachment = new Attachment();
                $attachment->owner_id = Yii::$app->user->id;
                $attachment->img_url = $imageFileUrl;
                $attachment->model_id = $model->id;
                if($attachment->save() === false){
                    throw new BadRequestHttpException(Yii::t("app", $attachment));
                }
            }
        }
        
       return $model;
    }
}