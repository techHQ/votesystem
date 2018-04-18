<?php

namespace app\controllers;
use yii;
use app\models\Lga;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\States;

class StatesController extends \yii\web\Controller
{
   
   public function actionIndex(){
        //run a query;
         $query = States::find();
         $pagination = new Pagination([
         'defaultPageSize'=>10,
         'totalCount'     =>$query->count(),
        ]);
        $states = $query->orderBy('state_name','state_id')
          ->offset($pagination->offset)
          ->limit($pagination->limit)
          ->all();

        return $this->render('index',
        [  'states'=> $states,
         'pagination'=> $pagination,
        ]);
    }



    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
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
