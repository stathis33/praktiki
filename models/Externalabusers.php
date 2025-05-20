<?php

namespace app\models;

use Yii;
use app\components\BaseActiveRecord;
/**
 * This is the model class for table "externalabusers".
 *
 * @property int $id
 * @property int|null $permission
 * @property string|null $IP
 * @property string|null $mask
 * @property int $status
 * @property string|null $date_added
 * @property string|null $date_modified
 * @property int|null $TTL
 * @property string|null $listed_by
 */
class Externalabusers extends BaseActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'externalabusers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'IP', 'mask', 'date_added', 'date_modified',], 'default', 'value' => 10],
        [['listed_by'], 'default', 'value' => 'AUTO'],
            [['permission','TTL'], 'default', 'value' => null],
            
            
            [[ 'status', 'TTL'], 'integer'],
            [['date_modified'], 'safe'],
    [['status'], 'required', 'message' => 'Το πεδίο Status είναι υποχρεωτικό.'],               

            [['permission'], 'required', 'message' => 'Το πεδίο Permission είναι υποχρεωτικό.'],               

                [['IP'], 'unique', 'message' => 'Αυτή η IP υπάρχει ήδη .'],

        ['IP', 'match', 'pattern' => '/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\.|$)){4}$/', 'message' =>'Η IP πρέπει να είναι σε μορφή x.x.x.x με αριθμούς από 0 έως 255.'],
               
            [['mask'], 'required'],
        ['mask', 'match', 'pattern' => '/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\.|$)){4}$/', 'message' => 'Η Mask πρέπει να είναι σε μορφή x.x.x.x με αριθμούς από 0 έως 255.'],
           
            
        ];
    }

public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {
        $this->date_modified = date('Y-m-d H:i:s'); // Πάντα ενημερώνεται

        if ($insert) {
            $this->date_added = date('Y-m-d H:i:s'); // Μόνο κατά το create
        }

      
        return true;
    }
    return false;
}

public static function getStatusList()
{
    return [
        0 => 'blacklist',
        1 => 'whitelist',  
         ];
}

public function getStatusName()
{
    $list = self::getStatusList();
    return $list[$this->status] ?? 'Unknown';
}

public static function getPermissionList()
{
    return \yii\helpers\ArrayHelper::map(
        \app\models\Permission::find()->all(),
        'id',
        'type_permission'
    );
}
public function getLogs()
{
    return \app\models\LogTable::find()
        ->where(['table_name' => 'external_abuser', 'row_id' => $this->id])
        ->orderBy(['changed_at' => SORT_DESC])
        ->all();
}

    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'permission' => 'Permission',
            'IP' => 'Ip',
            'mask' => 'Mask',
            'status' => 'Status',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
            'TTL' => 'Ttl',
            'listed_by' => 'Listed By',
        ];
    }

}
