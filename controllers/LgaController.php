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

class LgaController extends \yii\web\Controller {
    

    public function actionIndex(){

    	$lgas_query = Lga::find();

       

        $lgaCount = $lgas_query->count();

        $pagination = new Pagination([

            'defaultPageSize'=> 10,
            'totalCount'=>$lgaCount,

        ]);

        $lgas = $lgas_query->orderBy('lga_name ASC')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

         return $this->render('index', ['lgas'=>$lgas,'pagination'=>$pagination]);

    }

}
