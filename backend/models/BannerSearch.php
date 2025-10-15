<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Banner;

class BannerSearch extends Banner
{
    public function rules()
    {
        return [
            [['id', 'status', 'sort_order'], 'integer'],
            [['title', 'page', 'link', 'image'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Banner::find()->orderBy(['sort_order' => SORT_ASC]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false, // optional for drag/drop
            'sort' => false,       // <- disables sorting completely (recommended)
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['status' => $this->status]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['page' => $this->page]);

        return $dataProvider;
    }
}
