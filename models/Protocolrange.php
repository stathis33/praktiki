<?php

namespace app\models;
use app\components\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "protocolrange".
 *
 * @property int $id
 * @property string $range_param
 *
 * @property Bogon[] $bogons
 * @property Spamhaus[] $spamhauses
 */
class Protocolrange extends BaseActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'protocolrange';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['range_param'], 'required'],
            [['range_param'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'range_param' => 'Range Param',
        ];
    }

    /**
     * Gets query for [[Bogons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBogons()
    {
        return $this->hasMany(Bogon::class, ['range_parameter' => 'id']);
    }

    /**
     * Gets query for [[Spamhauses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpamhauses()
    {
        return $this->hasMany(Spamhaus::class, ['range_parameter' => 'id']);
    }

}
