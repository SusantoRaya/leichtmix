<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_shop".
 *
 * @property int $product_id
 * @property int $shop_id
 * @property string $shop_link
 *
 * @property Product $product
 * @property Shop $shop
 */
class ProductShop extends ActiveRecord
{
    public static function tableName()
    {
        return 'product_shop';
    }

    public static function primaryKey()
    {
        return ['product_id', 'shop_id']; // composite key
    }

    public function rules()
    {
        return [
            [['product_id', 'shop_id', 'shop_link'], 'required'],
            [['product_id', 'shop_id'], 'integer'],
            [['shop_link'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'product_id' => 'Product',
            'shop_id' => 'Shop',
            'shop_link' => 'Shop Link',
        ];
    }

    // 🔹 Relations
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id' => 'shop_id']);
    }
}
