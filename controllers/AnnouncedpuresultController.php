<?php

namespace app\controllers;
use yii;
use app\models\Announcedpuresults;
use app\models\Pollingunit;
use yii\data\Pagination;

class AnnouncedpuresultController extends \yii\web\Controller
{
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex()
    {  
        //run a query;
          $query = Announcedpuresults::find();
          $model = Pollingunit::find()->all();
         
         $pagination = new Pagination([
         'defaultPageSize'=>10,
         'totalCount'     =>$query->count(),
        ]);
        $puresults = $query->orderBy('polling_unit_uniqueid','result_id')
          ->offset($pagination->offset)
          ->limit($pagination->limit)
          ->all();

        return $this->render('index',
        [  'puresults'=> $puresults,
          'pagination'=> $pagination,
          'model'=> $model,
        ]);
    }







    public function actionRegister()
    {
        return $this->render('register');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
