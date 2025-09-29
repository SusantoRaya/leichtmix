<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\BaseActiveRecord;

/**
 * This is the model class for table "shop".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Product[] $products
 * @property ProductShop[] $productShops
 */
class Shop extends BaseActiveRecord
{

    /** @var UploadedFile */
    public $buttonImageFile;
    /** @var UploadedFile */
    public $buttonImageAltFile;


    public static function tableName()
    {
        return 'shop';
    }

    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['status', 'created_at', 'updated_at', 'sort'], 'integer'],
            [['name', 'url', 'button_image', 'button_image_alt'], 'string', 'max' => 255],
            [['buttonImageFile', 'buttonImageAltFile'], 'file', 'extensions' => 'png, jpg, jpeg, webp', 'skipOnEmpty' => true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Shop Name',
            'url' => 'Shop URL',
            'status' => 'Status',
            'sort' => 'Sort Order',
            'button_image' => 'Button Image',
            'button_image_alt' => 'Button Image (Alt)',
            'buttonImageFile' => 'Upload Button Image',
            'buttonImageAltFile' => 'Upload Button Image (Alt)',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    // 🔹 Relations
    public function getProductShops()
    {
        return $this->hasMany(ProductShop::class, ['shop_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->viaTable('product_shop', ['shop_id' => 'id']);
    }

    // 🔹 Upload handler
    public function upload()
    {
        if ($this->validate()) {
            if ($this->buttonImageFile) {
                $fileName = uniqid('shop_btn_') . '.' . $this->buttonImageFile->extension;
                $path = Yii::getAlias('@uploads/shop/') . $fileName;
                $this->buttonImageFile->saveAs($path);
                $this->button_image = $fileName;
            }

            if ($this->buttonImageAltFile) {
                $fileNameAlt = uniqid('shop_btn_alt_') . '.' . $this->buttonImageAltFile->extension;
                $pathAlt = Yii::getAlias('@uploads/shop/') . $fileNameAlt;
                $this->buttonImageAltFile->saveAs($pathAlt);
                $this->button_image_alt = $fileNameAlt;
            }
            return true;
        }
        return false;
    }

    public function getButtonImageUrl()
    {
        return $this->button_image ? Yii::$app->params['frontendHostInfo'] . '/uploads/shop/'. $this->button_image : null;
    }

    public function getButtonImageAltUrl()
    {
        return $this->button_image_alt ? Yii::$app->params['frontendHostInfo'] . '/uploads/shop/' . $this->button_image_alt : null;
    }

}
