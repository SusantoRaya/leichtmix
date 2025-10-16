<?php

namespace backend\controllers;

use common\models\ProductPreparation;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use common\models\Product;

/**
 * ProductPreparationController implements the CRUD actions for ProductPreparation model.
 */
class ProductPreparationController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ProductPreparation models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductPreparation::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductPreparation model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($product_id = null)
    {
        $model = new ProductPreparation();


        // Pre-select the product if an ID is passed in the URL
        if ($product_id !== null) {
            $model->product_id = $product_id;
        }

        // Fetch all products for the dropdown list
        $products = ArrayHelper::map(Product::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile && $model->upload()) {
                // image successfully uploaded, save model
                $model->save(false);
            } else {
                $model->save();
            }

            return $this->redirect(['product/view', 'id' => $product_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'products' => $products
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile && $model->upload()) {
                if ($oldImage && file_exists(Yii::getAlias('@uploads/product/preparation/' . $oldImage))) {
                    unlink(Yii::getAlias('@uploads/product/preparation/' . $oldImage));
                }
            } else {
                $model->image = $oldImage;
            }

            $model->save(false);
            return $this->redirect(['product/view', 'id' => $model->product_id]);
        }

        // Fetch all products for the dropdown list
        $products = ArrayHelper::map(Product::find()->all(), 'id', 'name');

        return $this->render('update', [
            'model' => $model,
            'products' => $products
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->image && file_exists(Yii::getAlias('@uploads/product/preparation/' . $model->image))) {
            unlink(Yii::getAlias('@uploads/product/preparation/' . $model->image));
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductPreparation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return ProductPreparation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductPreparation::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionReorder()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $order = Yii::$app->request->post('order', []);

        if (!empty($order)) {
            foreach ($order as $position => $id) {
                Yii::$app->db->createCommand()
                    ->update('product_preparation', ['sort_order' => $position + 1], ['id' => $id])
                    ->execute();
            }
            return ['success' => true];
        }

        return ['success' => false];
    }

}
