<?php

namespace app\models;
use app\components\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "protocol".
 *
 * @property int $id
 * @property string $type_protocol
 *
 * @property Bogon[] $bogons
 * @property Spamhaus[] $spamhauses
 */
class Protocol extends BaseActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'protocol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_protocol'], 'required'],
            [['type_protocol'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_protocol' => 'Type Protocol',
        ];
    }

    /**
     * Gets query for [[Bogons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBogons()
    {
        return $this->hasMany(Bogon::class, ['protocol' => 'id']);
    }

    /**
     * Gets query for [[Spamhauses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpamhauses()
    {
        return $this->hasMany(Spamhaus::class, ['protocol' => 'id']);
    }

}
