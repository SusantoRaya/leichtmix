<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\ProductShop;
use common\models\ProductCategory;

/**
 * Site controller
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($category_slug = null)
    {
        $categories = ProductCategory::find()
            ->where(['status' => 1])
            ->orderBy(['name' => SORT_ASC])
            ->with(['products' => function ($q) {
                $q->andWhere(['status' => 1]);
            }])
            ->all();

        return $this->render('/site/product/index2', [
            'categories' => $categories,
        ]);
    }

    public function actionDetail($category_slug = null, $product_slug = null)
    {
        $model = Product::findOne(['slug' => $product_slug, 'status' => 1]);

        if (!$model) {
            throw new NotFoundHttpException('Product not found.');
        }

        $relatedProducts = $model->getRelatedProductsFinal();

        return $this->render('/site/product/detail', [
            'model' => $model,
            'relatedProducts' => $relatedProducts,
        ]);
    }



    public function actionProduct() {}
}
