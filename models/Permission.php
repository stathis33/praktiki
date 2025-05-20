<?php

namespace app\models;
use app\components\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "permission".
 *
 * @property int $id
 * @property string $type_permission
 *
 * @property Bogon[] $bogons
 * @property Spamhaus[] $spamhauses
 */
class Permission extends BaseActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_permission'], 'required'],
            [['type_permission'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_permission' => 'Type Permission',
        ];
    }

    /**
     * Gets query for [[Bogons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBogons()
    {
        return $this->hasMany(Bogon::class, ['permission' => 'id']);
    }

    /**
     * Gets query for [[Spamhauses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpamhauses()
    {
        return $this->hasMany(Spamhaus::class, ['permission' => 'id']);
    }

}
