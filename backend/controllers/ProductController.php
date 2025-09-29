<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                // remove commas
                $model->price = str_replace(',', '', $model->price);
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->guideFileUpload = UploadedFile::getInstance($model, 'guideFileUpload');

                if ($model->upload() && $model->uploadGuide() && $model->save(false)) {

                    $shopLinks = Yii::$app->request->post('Product')['shopLinks'] ?? [];

                    foreach ($shopLinks as $shopId => $link) {
                        $ps = \common\models\ProductShop::findOne([
                            'product_id' => $model->id,
                            'shop_id' => $shopId
                        ]);
                        if (!$ps) {
                            $ps = new \common\models\ProductShop();
                            $ps->product_id = $model->id;
                            $ps->shop_id = $shopId;
                        }
                        $ps->shop_link = $link;
                        $ps->save(false);
                    }

                    Yii::$app->session->setFlash('success', 'Product created successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                // remove commas
                $model->price = str_replace(',', '', $model->price);
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->guideFileUpload = UploadedFile::getInstance($model, 'guideFileUpload');

                if ($model->upload() && $model->uploadGuide() && $model->save(false)) {

                    $shopLinks = Yii::$app->request->post('Product')['shopLinks'] ?? [];

                    foreach ($shopLinks as $shopId => $link) {
                        $ps = \common\models\ProductShop::findOne([
                            'product_id' => $model->id,
                            'shop_id' => $shopId
                        ]);
                        if (!$ps) {
                            $ps = new \common\models\ProductShop();
                            $ps->product_id = $model->id;
                            $ps->shop_id = $shopId;
                        }
                        $ps->shop_link = $link;
                        $ps->save(false);
                    }

                    Yii::$app->session->setFlash('success', 'Product updated successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
