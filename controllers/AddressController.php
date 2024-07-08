<?php

namespace app\controllers;

use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\data\Pagination;
use app\models\Address;

class AddressController extends ActiveController
{
    public $modelClass = 'app\models\Address';

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
        $query = Address::find();

        $pagination = new Pagination(
            [
                'totalCount' => $query->count(),
                'pageSize' => 5,
                'defaultPageSize' => 5,
                'page' => $page
            ]
        );

        $address = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->asJson([
            'address' => $address,
            'pagination' => $pagination
        ]);
    }
}
