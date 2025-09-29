<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property int|null $parent_id
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Product[] $products
 * @property ProductCategory $parent
 * @property ProductCategory[] $children
 */
class ProductCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'product_category';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',   // source column
                'slugAttribute' => 'slug', // target column
                'ensureUnique' => true,   // make sure slug is unique
            ],
             TimestampBehavior::class,
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Category Name',
            'slug' => 'Slug',
            'parent_id' => 'Parent Category',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    // 🔹 Relations
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    public function getParent()
    {
        return $this->hasOne(self::class, ['id' => 'parent_id']);
    }

    public function getChildren()
    {
        return $this->hasMany(self::class, ['parent_id' => 'id']);
    }

    public function getFaqs()
    {
        return $this->hasMany(Faq::class, ['product_category_id' => 'id']);
    }
}
