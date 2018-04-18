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

class ResultsController extends \yii\web\Controller {

    public function actionPollingUnit(){

        $ann_pu_res_query = AnnouncedPuResults::find();

        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $ann_pu_res_query->count()
        ]);


        $ann_pu_res = $ann_pu_res_query
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();


        return $this->render('polling-unit', ['ann_pu_res'=>$ann_pu_res,'pagination' => $pagination]);

    }

    public function actionWard(){

        return $this->render('ward');

    }


    public function actionLga(){
        return $this->render('lga');
    }


    public function actionLgaResult($id){

        
        //////////////////////////////////////////////////////////////////////////////
        // $puCount = PollingUnit::find()
        //         ->where(['lga_id'=>$id])
        //         ->count();
        // $puMatch = PollingUnit::find()
        //         ->where(['lga_id'=>$id])
        //         ->all();

        // $matchRes = [];

        // foreach($puMatch as $match){
        //     $puResMatch = AnnouncedPuResults::find()
        //                     ->where(['polling_unit_uniqueid'=>$match->uniqueid])
        //                     ->all();
        //     echo $match->uniqueid."<br>";
        //     if(count($puResMatch) > 0){
        //         array_push($matchRes, $puResMatch);
        //     }
        // }

        // foreach ($matchRes as $match) {

        // }
        /////////////////////////////////////////////////////////////////////////

        // echo "<pre>";
        //         var_dump($matchRes[0]);
        //         echo "total : ".$puCount;
            
        //         echo "</pre>";
        //         die();
        
        // $res = AnnouncedPuResults::find()
        //                         ->where(['polling_unit_uniqueid'=>PollingUnit::find('uniqueid')->where(['lga_id'=>$id])])
        //                         ->all();
        // $
        // foreach()
        // $res = AnnouncedPuResults::find()
        //         ->where(['polling_unit_uniqueid'=>$pus])
        //         ->all();

        $pu_uniqueids = PollingUnit::find('uniqueid')
                            ->where(['lga_id'=>$id])
                            ->all();

        // foreach($pu_uniqueids as $pu_uniqueid){

        // }

        // echo "<pre>";
        // var_dump($pu_uniqueid);
        // echo "</pre>";
        // die();

               


        return $this->render('lga-result', ['pu_uniqueids'=>$pu_uniqueids]);

    }

    public function actionResultByLga($id){

        //  getting all unique ids of match LGAs

        $pu_uniqueids = PollingUnit::find('uniqueid')
                            ->where(['lga_id'=>$id])
                            ->all();

        if($pu_uniqueids){
    
            foreach($pu_uniqueids as $pu_uniqueid){

               

                $results = AnnouncedPuResults::find()
                            ->where(['polling_unit_uniqueid'=>$pu_uniqueid])
                            ->all();

                

            } 

            $total = 0;

            if($results){
                echo '<table class="table table-header table-bordered table-striped">
                        <thead>
                            <th>Polling Unit Name</th>
                            <th>Polling Unit Ward</th>
                            <th>Polling Unit Lga</th>
                            <th>Party Name</th>
                            <th>Party Score</th>
                        </thead>
                        <tbody>';
                foreach($results as $result){

                   echo '<tr>
                        <td>'.$result->polling_unit->polling_unit_name.'</td>
                        <td>'.$result->polling_unit->ward->ward_name.'</td>
                        <td>'.$result->polling_unit->lga->lga_name.'</td>
                        <td>'.$result->party_abbreviation.'</td>
                        <td>'.$result->party_score.'</td>
                    </tr>';

                    $total += $result->party_score;

                }

                echo '<tr>
                    <td colspan="4"><strong class="text-center">Total</strong></td>
                    <td><strong>'.$total.'</strong></td>
                </tr>

                            
                        </tbody>
                    </table>';
                 } else {
                    echo "No Result available For This LGA.";
                }
                        
            } else {
            
                echo "No Polling Unit Available For This LGA.";

        }

    }

    public function actionNew_pu(){
        $new_result = new AnnouncedPuResults();

        if ($new_result->load(Yii::$app->request->post())) {                

            if ($new_result->validate()) {
                    
                $new_result->save();

                Yii::$app->session->setFlash('success', 'Result Added Successfully');

                return $this->redirect('new_pu');
            }
        }

        return $this->render('new_pu', [
            'new_result' => $new_result,
        ]);
    }


    public function actionWardByLga($id){
        $wards = Ward::find()
                ->where(['lga_id'=>$id])
                ->all();

        if($wards){

            foreach($wards as $ward){
                echo "<option value='".$ward->ward_id."'>".$ward->ward_name."</option>";
            }

        }else{

        }
    }

    public function actionPuByWard($id){
        $pus = PollingUnit::find()
                ->where(['ward_id'=>$id])
                ->all();

      

        if($pus){

            foreach($pus as $pu){
                echo "<option value='".$pu->uniqueid."'>".$pu->polling_unit_name."</option>";
            }

        }else{

        }
    }

    public function actionPartyByPuUid($id){

        $party_names = AnnouncedPuResults::find('party_abbreviation')
                                    ->select('party_abbreviation')
                                    ->where(['polling_unit_uniqueid'=>$id])
                                    ->column();
        // echo "<pre>";
        // var_dump($party_names);
        // echo "</pre>";
        // die();

                // foreach($pu_uniqueids as $pu_uniqueid){
                //     $results = AnnouncedPuResults::find('party_abbreviation')
                //                     ->where(['polling_unit_uniqueid'=>$pu_uniqueid])
                //                     ->all();
                // }        

        $parties = Party::find()
            ->select(['partyname', 'partyid'])
            ->indexBy('partyid')
            ->column();
        // echo "<pre>";
        // var_dump($parties);
        // echo "</pre>";
        // die();

        if($party_names){

            $parties_to_list = array_diff($parties, $party_names);

            if(count($parties_to_list) > 0){
                foreach ($parties_to_list as $party) {
                    echo "<option value='".substr($party, 0, 4)."'>".substr($party, 0, 4)."</option>";
                }
            } else {

                 echo "All Parties Results For This Polling Unit Filled";

            }            

        } else {

            foreach ($parties as $party) {
                echo "<option value='".substr($party, 0, 4)."'>".substr($party, 0, 4)."</option>";
            }

        }

        

        // echo "<pre>";
        // var_dump($parties_to_list);
        // echo "</pre>";
        // die();

    }

    public function actionListLgaByState($id){
        $lgas = Lga::find()
                    ->where(['state_id'=>$id])
                    ->all();

        foreach($lgas as $lga){
            echo "<option value='".$lga->lga_id."'>".$lga->lga_name."</option>";
        }
    }

    public function actionListPollingUnitUidByLga($id){
        $polling_units = PollingUnit::find()
                                ->where(['lga_id'=>$id])
                                ->all();
        foreach ($polling_units as $polling_unit) {
            echo "<option value='".$polling_unit->uniqueid."'>".$polling_unit->polling_unit_name."</option>";
        }
    }

    public function actionListResultByPollingUnitUid($id){
        $results = AnnouncedPuResults::find()
                    ->where(['polling_unit_uniqueid'=>$id])
                    ->all();

        if($results){

            echo '<table class="table table-header table-bordered table-striped">
                        <thead>
                            <th>Polling Unit Name</th>
                            <th>Polling Unit Ward</th>
                            <th>Polling Unit Lga</th>
                            <th>Party Name</th>
                            <th>Party Score</th>
                        </thead>
                        <tbody>';
            $total = 0;
            foreach($results as $result){

                   echo '<tr>
                        <td>'.$result->polling_unit->polling_unit_name.'</td>
                        <td>'.$result->polling_unit->ward->ward_name.'</td>
                        <td>'.$result->polling_unit->lga->lga_name.'</td>
                        <td>'.$result->party_abbreviation.'</td>
                        <td>'.$result->party_score.'</td>
                    </tr>';

                    $total += $result->party_score;

                }

                echo '<tr>
                    <td colspan="4"><strong class="text-center">Total</strong></td>
                    <td><strong>'.$total.'</strong></td>
                </tr>

                            
                        </tbody>
                    </table>';
        } else {
            echo "No Result available For This LGA.";
        }

    }
}
