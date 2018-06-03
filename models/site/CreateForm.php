<?php

namespace app\models\site;

use app\models\Attachment;
use app\models\Title;
use yii\base\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CreateForm extends Model {

    public $name;
    public $content;
    public $currency;
    public $apk_uid;
    public $log;
    public $imageFile;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false],
            //[['name'], 'required'],
            //[["content",'currency', 'log', 'apk_uid'], "safe"],
            //['log', 'file', 'skipOnEmpty' => false],
        ];
    }
    

    public function save() {
        if (!$this->validate()) {
            return $this;
        }
        
//        $model = new Title();
//        $model->name = 'XXXX';
//        $model->content = 'XXXXX';
//        $model->currency = 'XXXXXX';
//        $model->log = $this->log;
//        if($model->save() === false){
//            die("xx");
//            return false;
//        }
        
        
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(dirname(dirname(__DIR__)).'/runtime/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
    

    public function getAttachment() {
        return Attachment::findOne(["uid" => $this->apk_uid]);
    }

}
