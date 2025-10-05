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
            ->alias('c')
            ->where(['c.status' => 1])
            ->andWhere([
                'IN',
                'c.id',
                ProductCategory::find()
                    ->select('parent_id')
                    ->where(['IS NOT', 'parent_id', null])
            ])
            ->orderBy(['c.sort' => SORT_ASC, 'c.name' => SORT_ASC])
            ->all();
    }

    public static function getModernCategories()
    {
        return ProductCategory::find()
            ->alias('c')
            ->where(['c.status' => 1])
            ->andWhere(['c.parent_id' => null])
            ->andWhere(['NOT IN', 'c.id', ProductCategory::find()->select('parent_id')->where(['IS NOT', 'parent_id', null])])
            ->orderBy(['c.sort' => SORT_ASC, 'c.name' => SORT_ASC])
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
