<?php

namespace app\common\model;

use think\File;
use think\Model;

/**
 * This is the model class for table "os_upload_attach".
 *
 * @property string $id
 * @property string $original
 * @property string $file_name
 * @property string $hash
 * @property string $url
 * @property string $path
 * @property integer $size
 * @property string $created_at
 */
class UploadImages extends Model
{

    /**
     * [$insert 插入]
     * @var [type]
     */
    protected $insert = ['created_at'];

    /**
     * [setCreatedAtAttr 自动插入时间]
     * @DateTime  2017-08-11T14:46:30+0800
     */
    protected function setCreatedAtAttr()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * @param File $file
     * @param string $uploadPath
     * @param string $savePath
     */
    public static function upload($file, $uploadPath, $savePath)
    {
        $md5 = static::hash($file->getPath() . DS . $file->getFilename());
        /**
         * @var UploadImages $fileData
         */
        $fileData = self::where(['hash' => $md5])->find();
        if (empty($fileData)) {
            $info = $file->move($uploadPath);
            if (!$info) {
                $this->error = $file->getError();
                return false;
            }
            $fileData = new static();
            $fileData->original = $info->getInfo('name');
            $fileData->file_name = $info->getFilename();
            $fileData->file_type = $info->getMime();
            $fileData->hash = $md5;
            $fileData->url = str_replace(DS, '/', $savePath . $info->getSaveName());
            $fileData->path = $info->getPath();
            $fileData->size = $info->getSize();
            if (!$fileData->save()) {
                $this->error = $fileData->getError();
                return false;
            }
        } else {
            if (!file_exists($fileData->path . DS . $fileData->file_name)) {
                $file->move($fileData->path, $fileData->file_name);
            }
        }
        return $fileData;
    }

    protected static function hash($filePath)
    {
        return md5(md5_file($filePath) . filesize($filePath));
    }

}
