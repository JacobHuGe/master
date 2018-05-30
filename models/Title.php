<?php

namespace app\models;

use app\behaviors\UniqueIdGenerator;
use app\helpers\FileHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Title extends ActiveRecord {

    public static function tableName() {
        return '{{%title}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                "class" => UniqueIdGenerator::className()
            ],
            [
                "class" => TimestampBehavior::className()
            ]
        ];
    }

    public function beforeSave($insert) {
        $uploadedFile = FileHelper::uploadFiles("log");  //Artcile[thumb]存储的图片字段
        var_Dump($uploadedFile);
        die;
        if ($uploadedFile != null) {

            $this->thumb = $uploadedFile['url'] . $uploadedFile['new_name'];

            echo $this->thumb;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [["content", 'currency', 'log'], "safe"]
        ];
    }

}
