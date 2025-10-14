<?php

namespace backend\controllers;

use Yii;
use common\models\Banner;
use backend\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class BannerController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Banner();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->save(false)) {
                Yii::$app->session->setFlash('success', 'Banner created successfully');
                return $this->redirect(['index']);
            }
        }

        $disabledPages = \common\models\Banner::find()
            ->select('page')
            ->where(['page' => ['homecat1', 'homecat2', 'homecat3', 'homecat4', 'homecat5', 'homecat6']])
            ->andWhere(['!=', 'id', $model->id ?? 0]) // ignore current record
            ->column();



        return $this->render('create', ['model' => $model, 'disabledPages' => $disabledPages]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile) {
                $model->upload();
            } else {
                $model->image = $oldImage; // keep old image
            }

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Banner updated successfully');
                return $this->redirect(['index']);
            }
        }

        $disabledPages = \common\models\Banner::find()
            ->select('page')
            ->where(['page' => ['homecat1', 'homecat2', 'homecat3', 'homecat4', 'homecat5', 'homecat6']])
            ->andWhere(['!=', 'id', $model->id ?? 0]) // ignore current record
            ->column();

        return $this->render('update', ['model' => $model, 'disabledPages' => $disabledPages]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->image && file_exists(Yii::getAlias('@bannerPath') . '/' . $model->image)) {
            unlink(Yii::getAlias('@bannerPath') . '/' . $model->image);
        }

        $model->delete();
        Yii::$app->session->setFlash('success', 'Banner deleted');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested banner does not exist.');
    }

    public function actionReorder()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $order = Yii::$app->request->post('order', []);

        if (!empty($order)) {
            foreach ($order as $position => $id) {
                Yii::$app->db->createCommand()
                    ->update('banner', ['sort_order' => $position + 1], ['id' => $id])
                    ->execute();
            }
            return ['success' => true];
        }

        return ['success' => false];
    }
}
