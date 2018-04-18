<?php

namespace app\controllers;
use yii;
use app\models\Ward;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
class WardController extends \yii\web\Controller{
 
  public function actionIndex(){
        
        
         //run a query;
         $query = Ward::find();
         $pagination = new Pagination([
         'defaultPageSize'=>10,
         'totalCount'     =>$query->count(),
        ]);
        $wards = $query->orderBy('ward_name','ward_id')
          ->offset($pagination->offset)
          ->limit($pagination->limit)
          ->all();

        return $this->render('index',
        [  'wards'=> $wards,
         'pagination'=> $pagination,
        ]);

    }




    public function actionCreate()
    {
        return $this->render('create');
    }

    
    public function actionRegister()
    {
        return $this->render('register');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }
     public function actionLists($id){
        // $departments = Department::find()->where(['fact_id'=>$id])->all();

        // if($departments > 0){
        //   foreach ($departments as $department) {
        //     echo "<option value='".$department->deptart_id."'>".$department->depart_name."</option>";
        //   }
        // }

       $countWard = Ward::find()
                        ->where(['lga_id'=>$id])
                        ->count(); 


       $wards = Ward::find()
                        ->where(['lga_id'=>$id])
                        ->all();

      if($countWard > 0){

        // $save="";
        // $save.="<option>Select a department...</option>";
        foreach($wards as $ward){

          // $save.= "<option value='".$department->depart_id."'>".$department->depart_name."</option>";
          //  $save;
          echo "<option value='".$ward->ward_id."'>".$ward->ward_name."</option>";
        }

         

        }else{
         echo "<option>-</option>";

      }

    }

}
