<?php
namespace app\helpers;

use yii\web\UploadedFile;

/**
 * 北京指南科技科有限公司
 * 版权所有，未经授权，不得擅自复制和传播，公司保留所有诉讼权利。
 * @author liangfujian
 * @ctime 2016-11-08
 * @mtime 2016-11-08
 * Website: http://www.zhinantech.com/
 */
class FileHelper {
    public static function uploadFiles($name){

        $uploadedFile=UploadedFile::getInstanceByName($name);

        if($uploadedFile === null || $uploadedFile->hasError){
            return '文件不存在';
        }

        //创建时间
        $ymd=date("Ymd");

        //存储到本地的路径
        $save_path=\Yii::getAlias('@uploads').'/'.$ymd.'/';


        //存储到数据库的地址
        $save_url='uploads'.'/'.$ymd.'/';


        //file_exists() 函数检查文件或目录是否存在
        //mkdir() 函数创建目录

        if(!file_exists($save_path)){

            mkdir($save_path);

        }


        //图片名称
        $file_name = $uploadedFile->getBaseName();



        //图片格式
        $file_ext = $uploadedFile->getExtension();



        //新文件名
        $new_file_name=date("YmdHis").'_'.rand(10000,99999).'.'.$file_ext;



        //图片信息
        $uploadedFile->saveAs($save_path.$new_file_name);

        return ['path'=>$save_path,'url'=>$save_url,'name'=>$file_name,'new_name'=>$new_file_name,'ext'=>$file_ext];
    }

}