<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

class Banner extends \yii\db\ActiveRecord
{
    public $imageFile;

    const PAGES = [
        'home' => 'Home',
        'aboutus' => 'Aboutus',
        'certificate' => 'Certificate',
        'support_faq' => 'Support FAQ',
        'support_guide' => 'Support Guide',
        'support_video' => 'Support Video',
        'homecat1' => 'Home Category 1',
        'homecat2' => 'Home Category 2',
        'homecat3' => 'Home Category 3',
        'homecat4' => 'Home Category 4',
        'homecat5' => 'Home Category 5',
        'homecat6' => 'Home Category 6',
    ];

    public static function tableName()
    {
        return 'banner';
    }

    public function rules()
    {
        return [
            [['title', 'page'], 'required'],
            [['status', 'sort_order'], 'integer'],
            [['title', 'image', 'link'], 'string', 'max' => 255],
            [['page'], 'in', 'range' => array_keys(self::PAGES)],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg, webp', 'skipOnEmpty' => true],
            [['page'], 'validateUniqueHomeCategory'], // custom validator
        ];
    }

    public function validateUniqueHomeCategory($attribute, $params)
    {
        $restricted = ['homecat1', 'homecat2', 'homecat3', 'homecat4', 'homecat5', 'homecat6'];

        if (in_array($this->$attribute, $restricted, true)) {
            $exists = self::find()
                ->where(['page' => $this->$attribute])
                ->andWhere(['!=', 'id', $this->id ?? 0]) // exclude current record when updating
                ->exists();

            if ($exists) {
                $this->addError($attribute, 'A banner for ' . self::PAGES[$this->$attribute] . ' already exists.');
            }
        }
    }

    public function upload()
    {
        if ($this->imageFile) {
            $fileName = uniqid() . '.' . $this->imageFile->extension;
            $path = Yii::getAlias('@bannerPath') . '/' . $fileName;

            if ($this->imageFile->saveAs($path)) {
                $this->image = $fileName;
                return true;
            }
        }
        return false;
    }

    public function getImageUrl()
    {
        // Prefer configured frontend domain
        $host = Yii::$app->params['frontendHostInfo'] ?? (Yii::$app->has('request') ? Yii::$app->request->getHostInfo() : '');
        $base = $host ? rtrim($host, '/') : '';
        return $base . '/uploads/banner/' . $this->image;
    }

   
}
