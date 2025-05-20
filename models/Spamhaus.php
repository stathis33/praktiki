<?php

namespace app\models;
use app\components\BaseActiveRecord;
use yii\db\ActiveRecord;

class Spamhaus extends BaseActiveRecord
{
    public static function tableName()
    {
        return 'spamhaus';
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
