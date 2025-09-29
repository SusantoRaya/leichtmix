<?php

namespace frontend\components;

use Yii;
use yii\base\Component;
use common\models\Banner;

class BannerComponent extends Component
{
    /**
     * Get a banner model by page (e.g. homecat1, homecat2, ...)
     * Returns null if not found or inactive
     */
    public function getByPage(string $page): ?Banner
    {
        return Banner::find()
            ->where(['page' => $page, 'status' => 1])
            ->one();
    }

    /**
     * Get all home category banners at once
     * @return Banner[]
     */
    public function getHomeCategories(): array
    {
        $pages = ['homecat1', 'homecat2', 'homecat3', 'homecat4', 'homecat5', 'homecat6'];

        return Banner::find()
            ->where(['page' => $pages, 'status' => 1])
            ->indexBy('page')
            ->all();
    }

    public function getHomeBanners(): array
    {
        $pages = ['home'];

        return Banner::find()
            ->where(['page' => $pages, 'status' => 1])
            ->orderBy(['sort_order' => SORT_ASC])
            ->all();
    }
}
