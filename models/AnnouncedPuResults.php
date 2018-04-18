<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "announced_pu_results".
 *
 * @property integer $result_id
 * @property string $polling_unit_uniqueid
 * @property string $party_abbreviation
 * @property integer $party_score
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class AnnouncedPuResults extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announced_pu_results';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['party_abbreviation', 'party_score', 'entered_by_user', 'date_entered', 'user_ip_address'], 'required'],
            [['party_score'], 'integer'],
            [['date_entered'], 'safe'],
            [['polling_unit_uniqueid', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
            [['party_abbreviation'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'result_id' => 'Result ID',
            'polling_unit_uniqueid' => 'Polling Unit',
            'party_abbreviation' => 'Party',
            'party_score' => 'Party Score',
            'entered_by_user' => 'Entered By',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
        ];
    }



    // Announced Polling Unit Result Unit to Polling

    public function getPolling_unit(){
        return $this->hasOne(PollingUnit::className(), ['uniqueid'=>'polling_unit_uniqueid']);
    }

    public function beforeSave($insert){
        $this->polling_unit_uniqueid = Yii::$app->request->post()['AnnouncedPuResults']['polling_unit'];
        return parent::beforeSave($insert);
    }
}
