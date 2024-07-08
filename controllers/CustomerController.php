<?php

namespace app\controllers;

use yii\data\Pagination;
use app\models\Customer;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class CustomerController extends ActiveController
{
    public $modelClass = 'app\models\Customer';

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
        $query = Customer::find();

        $pagination = new Pagination(
            [
            'totalCount' => $query->count(), 
            'pageSize' => 5, 
            'defaultPageSize' => 5, 
            'page' => $page
            ]
        );

        $customers = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->asJson([
            'customers' => $customers,
            'pagination' => $pagination
        ]);
    }
}
