<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "log_table".
 *
 * @property int $id
 * @property string $table_name
 * @property string $primary_key
 * @property string $attribute
 * @property string|null $old_value
 * @property string|null $new_value
 * @property string|null $changed_at
 * @property int|null $changed_by
 * @property string|null $old_date
 * @property string|null $new_date
 */
class Log extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old_value', 'new_value', 'changed_by', 'old_date', 'new_date'], 'default', 'value' => null],
            [['table_name', 'primary_key', 'attribute'], 'required'],
            [['old_value', 'new_value'], 'string'],
            [['changed_at', 'old_date', 'new_date','changed_by'], 'safe'],
            [['changed_by'], 'string', 'max' => 255],
            [['table_name', 'primary_key', 'attribute'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'primary_key' => 'Primary Key',
            'attribute' => 'Attribute',
            'old_value' => 'Old Value',
            'new_value' => 'New Value',
            'changed_at' => 'Changed At',
            'changed_by' => 'Changed By',
            'old_date' => 'Old Date',
            'new_date' => 'New Date',
        ];
    }

}
