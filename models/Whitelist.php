<?php

namespace app\models;
use app\components\BaseActiveRecord;
use Yii;
use app\models\Log;
/**
 * This is the model class for table "whitelist".
 *
 * @property string $ip
 */
class Whitelist extends BaseActiveRecord
{
public $oldIp;
  
    public function beforeSave($insert)
    {
        if (!$insert) {
            $this->oldIp = $this->getOldAttribute('ip');
        }

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'whitelist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['ip'], 'required','message' => 'Το πεδίο IP είναι υποχρεωτικό.'],
             [['ip'], 'unique', 'message' => 'Αυτή η IP υπάρχει ήδη .'],

        ['ip', 'match', 'pattern' => '/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\.|$)){4}$/', 'message' => 'Η IP πρέπει να είναι σε μορφή x.x.x.x με αριθμούς από 0 έως 255.'],
            
     ];
    }
public function afterSave($insert, $changedAttributes)
{
    parent::afterSave($insert, $changedAttributes);

    foreach ($changedAttributes as $attribute => $oldValue) {
        if ($attribute === 'date_modified') {
            continue; // Αγνοούμε 
        }

        $log = new \app\models\Log();
        $log->table_name = 'whitelist';
        $log->primary_key = $this->ip;
        $log->attribute = $attribute;
        $log->old_value = $insert ? null : $oldValue;
        $log->new_value = $this->$attribute;
        $log->changed_by = Yii::$app->user->identity->username ?? null;
        $log->changed_at = date('Y-m-d H:i:s');
        $log->save(false);
    }
}
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ip' => 'Ip',
        ];
    }

}
