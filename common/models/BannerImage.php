<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner_image".
 *
 * @property int $id
 * @property int $banner_id
 * @property string $image
 * @property string|null $link
 * @property string|null $caption
 * @property int|null $sort_order
 * @property int|null $status
 * @property string|null $created_at
 *
 * @property Banner $banner
 */
class BannerImage extends \yii\db\ActiveRecord
{

    public $imageFiles; // for multiple uploads
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link', 'caption'], 'default', 'value' => null],
            [['sort_order'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 1],
            [['banner_id', 'image'], 'required'],
            [['banner_id', 'sort_order', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['image', 'link', 'caption'], 'string', 'max' => 255],
            [['banner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Banner::class, 'targetAttribute' => ['banner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banner_id' => 'Banner ID',
            'image' => 'Image',
            'link' => 'Link',
            'caption' => 'Caption',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Banner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(Banner::class, ['id' => 'banner_id']);
    }

    public function upload()
    {
        if ($this->imageFiles) {
            foreach ($this->imageFiles as $file) {
                $fileName = uniqid() . '.' . $file->extension;
                $path = Yii::getAlias('@uploads/banner/') . $fileName;
                $file->saveAs($path);

                $img = new BannerImage();
                $img->banner_id = $this->banner_id;
                $img->image = $fileName;
                $img->save(false);
            }
            return true;
        }

        return false;
    }

    public function getImageUrl()
    {
        return Yii::getAlias('@uploadsUrl/banner/') . $this->image;
    }
}
