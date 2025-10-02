<?php

namespace frontend\components;

use common\models\ProductCategory;
use common\models\SocialMedia;

class MenuHelper
{
    public static function getCategories()
    {
        return ProductCategory::find()
            ->where(['status' => 1])
            ->orderBy(['name' => SORT_ASC])
            ->all();
    }


    public static function getConventionalCategories()
    {
        return ProductCategory::find()
            ->where(['status' => 1])
            ->andWhere(['parent_id' => null])
            ->orderBy(['sort' => SORT_ASC, 'name' => SORT_ASC])
            ->all();
    }

    public static function getModernCategories()
    {
        return ProductCategory::find()
            ->where(['status' => 1])
            ->andWhere(['IS NOT', 'parent_id', null])
            ->orderBy(['sort' => SORT_ASC, 'name' => SORT_ASC])
            ->all();
    }


    public static function getSosmed()
    {
        return SocialMedia::find()
            ->where(['status' => 1])
            ->orderBy(['name' => SORT_ASC])
            ->all();
    }
}
