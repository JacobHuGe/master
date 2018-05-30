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

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['name'], 'required'],
            //[["content",'currency', 'log', 'apk_uid'], "safe"],
            ['log', 'file', 'skipOnEmpty' => false],
        ];
    }

    public function Save() {
        if (!$this->validate()) {
            return $this;
        }
        
        $model = new Title();
        $model->name = 'XXXX';
        $model->content = 'XXXXX';
        $model->currency = 'XXXXXX';
        $model->log = $this->log;
        if($model->save() === false){
            die("xx");
            return false;
        }
        
        
    }

    public function getAttachment() {
        return Attachment::findOne(["uid" => $this->apk_uid]);
    }

}
