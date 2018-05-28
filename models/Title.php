<?php
namespace \app\models;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Title extends yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%title}}';
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                "class" => UniqueIdGenerator::className()
            ],
            [
                "class" => TimestampBehavior::className()
            ]
        ];
    }
    
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
}
