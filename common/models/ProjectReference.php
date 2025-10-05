<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;

class ProjectReference extends ActiveRecord
{
    /** @var UploadedFile */
    public $fileUpload;

    public static function tableName()
    {
        return 'project_reference';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['file'], 'string', 'max' => 255],
            [['fileUpload'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, jpg, jpeg, png'],
        ];
    }

    public function upload()
    {
        if ($this->fileUpload) {
            $dir = Yii::getAlias('@uploads/project/');
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }

            $fileName = uniqid() . '.' . $this->fileUpload->extension;
            $filePath = $dir . $fileName;
            if ($this->fileUpload->saveAs($filePath)) {
                $this->file = $fileName;
                return true;
            }
        }
        return false;
    }

    public function getFileUrl()
    {
        return Yii::$app->params['frontendHostInfo'] . '/uploads/project/' . $this->file;
    }
}
