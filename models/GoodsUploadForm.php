<?php
namespace app\models;
/**
 * Created by PhpStorm.
 * User: Zhiqiang Guo
 * Date: 2017/8/1
 * Time: 10:39
 */

use Yii;
use backend\models\GoodsPhoto;

/**
 * 图片上传
 * Class GoodsUploadForm
 * @package backend\models\form
 */
class GoodsUploadForm  extends GoodsPhoto
{

    public $imageFile;

    public function rules()
    {
        return [
            //数据验证这里可自己做
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,gif', 'maxFiles' => 4],
        ];
    }
    /**
     * 上传
     *
     * @author Zhiqiang Guo
     * @return void
     * @throws Exception
     * @access public
     */
    public function upload()
    {
        if ($this->validate()) {
            $path = Yii::getAlias('@uploadPath')  . date("Ymd");

            if (!is_dir($path) || !is_writable($path)) {
                \yii\helpers\FileHelper::createDirectory($path, 0777, true);
            }

            //upload_no 上传图片的商品的唯一码，为了在商品ID产生之前插入图片表数据标识。
            $uploadNo = Yii::$app->request->post('upload_no', '');
            //针对修改商品图片
            $goodsId = Yii::$app->request->post('goods_id', '0');
            foreach ($this->imageFile as $file) {
                $filedetail = '/goods_' . md5(uniqid() . mt_rand(10000, 99999999)) . '.' . $file->extension;
                $filePath = $path . $filedetail;   

                if ($file->saveAs($filePath)) {                   

                    //这里将上传成功后的图片信息保存到数据库
                    $imageUrl = $this->parseImageUrl($filePath);
                    $imageModel = new GoodsPhoto();
                    $imageModel->img = $imageUrl;
                    $imageModel->upload_no = $uploadNo;
                    $imageModel->goods_id = $goodsId;

                    $imageModel->save(false);
                    $imageId = Yii::$app->db->getLastInsertID();
                }
            }
            //图片上传后返回值
            return ['uploadNo' => $uploadNo, 'imageUrl' => $imageUrl,'imageId'=>$imageId];

        }
        return false;
    }

    /**
     * 这里在upload中定义了上传目录根目录别名，以及图片域名
     * @author Zhiqiang Guo
     * @return void
     * @throws Exception
     * @access public
     */
    private function parseImageUrl($filePath)
    {
        if (strpos($filePath, Yii::getAlias('@uploadPath')) !== false) {
            return  str_replace(Yii::getAlias('@uploadPath'), '', $filePath);
        } else {
            return $filePath;
        }
    }



}

---------------------

本文来自 无风的雨 的CSDN 博客 ，全文地址请点击：https://blog.csdn.net/guyan0319/article/details/78105499?utm_source=copy 