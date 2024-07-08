<?php

namespace app\controllers;

use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\data\Pagination;
use app\models\Product;

class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    public function actionIndex($page = 0)
    {
        $query = Product::find();

        $pagination = new Pagination(
            [
                'totalCount' => $query->count(),
                'pageSize' => 5,
                'defaultPageSize' => 5,
                'page' => $page
            ]
        );

        $products = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->asJson([
            'products' => $products,
            'pagination' => $pagination
        ]);
    }
}
