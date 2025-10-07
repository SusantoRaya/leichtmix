<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;


/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property float|null $price
 * @property string|null $image
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ProductCategory $category
 * @property Shop[] $shops
 * @property ProductShop[] $productShops
 */
class Product extends ActiveRecord
{

    public $imageFile;
    public $guideFileUpload;
    public $shopLinks = [];
    public $relatedProductIds = [];

    public static function tableName()
    {
        return 'product';
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->price !== null) {
                // make sure it's always a plain integer string
                $this->price = preg_replace('/[^\d]/', '', $this->price);
            }
            return true;
        }
        return false;
    }

    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['price'], 'safe'],
            [['name', 'slug', 'image'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['image'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['video_url'], 'string', 'max' => 255],
            [['guide_file'], 'string', 'max' => 255],
            [['relatedProductIds'], 'safe'],
            [['guideFileUpload'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,jpg,png,jpeg'],
        ];
    }

    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         if (!empty($this->price)) {
    //             Remove commas and convert to integer
    //             $this->price = (int) str_replace(',', '', $this->price);
    //         }
    //         return true;
    //     }
    //     return false;
    // }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',   // source column
                'slugAttribute' => 'slug', // target column
                'ensureUnique' => true,   // make sure slug is unique
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'name' => 'Product Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'price' => 'Price',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        foreach ($this->productShops as $ps) {
            $this->shopLinks[$ps->shop_id] = $ps->shop_link;
        }
        $this->relatedProductIds = $this->getRelatedProductsManual()->select('id')->column();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        \Yii::$app->db->createCommand()->delete('product_related', ['product_id' => $this->id])->execute();

        if (is_array($this->relatedProductIds)) {
            foreach ($this->relatedProductIds as $rid) {
                \Yii::$app->db->createCommand()->insert('product_related', [
                    'product_id' => $this->id,
                    'related_product_id' => $rid,
                ])->execute();
            }
        }
    }

    // 🔹 Relations
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'category_id']);
    }

    public function getProductShops()
    {
        return $this->hasMany(ProductShop::class, ['product_id' => 'id']);
    }

    public function getShops()
    {
        return $this->hasMany(Shop::class, ['id' => 'shop_id'])
            ->viaTable('product_shop', ['product_id' => 'id']);
    }

    public function getUrl()
    {
        return \yii\helpers\Url::to(['/product/view', 'slug' => $this->slug]);
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->imageFile) {
                $fileName = uniqid() . '.' . $this->imageFile->extension;
                $uploadPath = Yii::getAlias('@uploads/product/');
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $this->imageFile->saveAs($uploadPath . $fileName);
                $this->image = $fileName;
            }
            return true;
        }
        return false;
    }

    public function uploadGuide()
    {
        if ($this->guideFileUpload) {
            $fileName = uniqid() . '.' . $this->guideFileUpload->extension;
            $uploadPath = Yii::getAlias('@uploads/guide/');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            if ($this->guideFileUpload->saveAs($uploadPath . $fileName)) {
                $this->guide_file = $fileName;
                return true;
            }
            return false;
        }
        return true;
    }

    public function getGuideUrl()
    {
        return $this->guide_file ? Yii::$app->params['frontendHostInfo'] . '/uploads/guide/' . $this->guide_file : null;
    }

    public function getImageUrl()
    {
        return $this->image
            ? Yii::$app->params['frontendHostInfo'] . '/uploads/product/' . $this->image
            : Yii::$app->params['frontendHostInfo'] . '/uploads/product/no-image.png';
    }

    // public function getRelatedProducts($limit = 4)
    // {
    //     return self::find()
    //         ->where(['category_id' => $this->category_id])
    //         ->andWhere(['!=', 'id', $this->id])
    //         ->andWhere(['status' => 1])
    //         ->limit($limit)
    //         ->all();
    // }

    public function getRelatedProductsManual()
    {
        return $this->hasMany(Product::class, ['id' => 'related_product_id'])
            ->viaTable('product_related', ['product_id' => 'id']);
    }

    public function getRelatedProductsFinal($limit = 2)
    {
        $manual = $this->relatedProductsManual;
        if (!empty($manual)) {
            return $manual;
        }

        // fallback: same category
        return self::find()
            ->where(['category_id' => $this->category_id])
            ->andWhere(['!=', 'id', $this->id])
            ->andWhere(['status' => 1])
            ->limit($limit)
            ->all();
    }



    //  public function getImageUrl()
    // {
    //     // Prefer configured frontend domain
    //     $host = Yii::$app->params['frontendHostInfo'] ?? (Yii::$app->has('request') ? Yii::$app->request->getHostInfo() : '');
    //     $base = $host ? rtrim($host, '/') : '';
    //     return $base . '/uploads/banner/' . $this->image;
    // }
}
