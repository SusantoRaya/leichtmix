<?php

namespace backend\controllers;

use common\models\Faq;
use backend\models\FaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Product;
use common\models\ProductCategory;
use yii\helpers\ArrayHelper;

/**
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends Controller
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
     * Lists all Faq models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Faq model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($product_category_id = null)
    {
        $model = new Faq();
        
        // Pre-select the product if an ID is passed in the URL
        if ($product_category_id !== null) {
            $model->product_category_id = $product_category_id;
        }

        // Fetch all products for the dropdown list
        $product_categories = ArrayHelper::map(ProductCategory::find()->all(), 'id', 'name');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // Redirect back to the product view page
                return $this->redirect(['/product-category/view', 'id' => $model->product_category_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'product_categories' => $product_categories, // <-- Pass the products array to the view
        ]);
    }

    /**
     * Updates an existing Faq model.
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Fetch all products for the dropdown list
        $products = ArrayHelper::map(Product::find()->all(), 'id', 'name');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/product/view', 'id' => $model->product_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'products' => $products, // <-- Pass the products array to the view
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $productId = $model->product_id; // Store product_id before deleting
        $model->delete();

        // Redirect back to the product VIEW page
        return $this->redirect(['/product/view', 'id' => $productId]);
    }

    /**
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faq::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
