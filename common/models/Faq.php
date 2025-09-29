<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faq".
 *
 * @property int $id
 * @property int $product_id
 * @property string $question
 * @property string $answer
 * @property int $status
 * @property int|null $sort_order
 *
 * @property Product $product
 */
class Faq extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['sort_order'], 'default', 'value' => 0],
            [['product_category_id'], 'integer'],
            [['answer'], 'string'],
            [['question'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_category_id' => 'Product Category ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'status' => 'Status',
            'sort_order' => 'Sort Order',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getProduct()
    // {
    //     return $this->hasOne(Product::class, ['id' => 'product_id']);
    // }

    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'product_category_id']);
    }

}
