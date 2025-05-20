<?php

namespace app\models;

use yii\db\ActiveRecord;

class Bogon extends ActiveRecord
{
    public static function tableName()
    {
        return 'bogon';
    }

    
    public function getPermission0()
    {
        return $this->hasOne(Permission::class, ['id' => 'permission']);
    }

    
    public function getProtocol0()
    {
        return $this->hasOne(Protocol::class, ['id' => 'protocol']);
    }

    
    public function getRangeParameter0()
    {
        return $this->hasOne(Protocolrange::class, ['id' => 'range_parameter']);
    }
}
