<?php
namespace app\models\site;

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
    public $log;
    
    
        /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [["content",'currency', 'log'], "safe"]
        ];
    }
    
    public function Save()
    {
        if(!$this->validate()){
            return $this;
        }
    }

}