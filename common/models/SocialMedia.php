<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "social_media".
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property string $url
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class SocialMedia extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%social_media}}';
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
            [['name', 'url'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['icon'], 'string', 'max' => 100],
            [['url'], 'url'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Platform Name',
            'icon' => 'Icon (FontAwesome class)',
            'url' => 'URL',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
