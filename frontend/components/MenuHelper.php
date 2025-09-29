<?php

namespace frontend\components;

use common\models\ProductCategory;

class MenuHelper
{
    public static function getCategories()
    {
        return ProductCategory::find()
            ->where(['status' => 1])
            ->orderBy(['name' => SORT_ASC])
            ->all();
    }
}

?>