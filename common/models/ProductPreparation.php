<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class ProductPreparation extends ActiveRecord
{
    public $imageFile;

    public static function tableName()
    {
        return '{{%product_preparation}}';
    }

    public function rules()
    {
        return [
            [['product_id', 'title'], 'required'],
            [['product_id', 'sort_order'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, webp'],
        ];
    }

    public function upload()
    {
        if ($this->imageFile) {
            $fileName = uniqid() . '.' . $this->imageFile->extension;
            $uploadPath = Yii::getAlias('@uploads/product/preparation/');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $this->imageFile->saveAs($uploadPath . $fileName);
            $this->image = $fileName;
            return true;
        }
        return false;
    }

    public function getImageUrl()
    {
        return $this->image
            ? Yii::$app->params['frontendHostInfo'] . '/uploads/product/preparation/' . $this->image
            : Yii::$app->params['frontendHostInfo'] . '/uploads/product/no-image.png';
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
