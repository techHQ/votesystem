<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\AnnouncedLgaResults;
use app\models\AnnouncedPuResults;
use app\models\Ward;
use app\models\Lga;
use app\models\Party;
use app\models\PollingUnit;
use app\models\States;

use yii\data\Pagination;

class PollingUnitController extends \yii\web\Controller {

    public function actionIndex(){

    	$pu_query = PollingUnit::find();

    	$pagination = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $pu_query->count()
        ]);


        $polling_units = $pu_query
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();



        return $this->render('index', ['polling_units'=>$polling_units, 'pagination'=>$pagination]);
        
    }

    public function actionCreate(){

        $model = new PollingUnit();

	    if ($model->load(Yii::$app->request->post())) {

	        if ($model->validate()) {
	            // form inputs are valid, do something here
	            return;
	        }
	    }

	    return $this->render('create', [
	        'model' => $model,
	    ]);

    }

}
