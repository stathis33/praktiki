<?php
namespace app\components;

use Yii;
use yii\db\ActiveRecord;
use app\models\Log;
class BaseActiveRecord extends ActiveRecord
{
    public function getPrimaryKeyForLog(): string
{
    foreach ($this->attributes() as $attr) {
        if (strcasecmp($attr, 'ip') === 0) {
            return json_encode(['ip' => $this->getAttribute($attr)], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    return json_encode($this->getPrimaryKey(true), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
public function afterSave($insert, $changedAttributes)
{
    parent::afterSave($insert, $changedAttributes);

    if (empty($changedAttributes)) {
        return;
    }

    $excludedAttributes = ['date_modified', 'updated_at', 'last_seen']; // ➤ Τα αγνοούμε

    $db = Yii::$app->db;
    $transaction = $db->beginTransaction();

    try {
        foreach ($changedAttributes as $attribute => $oldValue) {
            $newValue = $this->getAttribute($attribute);

            // ➤ Αγνόησε πεδία που δεν άλλαξαν ουσιαστικά
            if ((string) $oldValue === (string) $newValue) {
                continue;
            }

            // ➤ Αγνόησε πεδία που δεν μας ενδιαφέρουν
            if (in_array($attribute, $excludedAttributes)) {
                continue;
            }

            $log = new Log();
            $log->table_name = static::tableName();
           $log->primary_key = $this->getPrimaryKeyForLog();

            $log->attribute = $attribute;
            $log->old_value = (string) $oldValue;
            $log->new_value = (string) $newValue;

            $log->old_date = $this->hasAttribute('date_modified') ? $changedAttributes['date_modified'] ?? null : null;
            $log->new_date = $this->hasAttribute('date_modified') ? $this->getAttribute('date_modified') : null;

            $log->changed_by = Yii::$app->user->identity->username ?? null;
            $log->changed_at = date('Y-m-d H:i:s');

            $log->save(false);
        }

        $transaction->commit();
    } catch (\Throwable $e) {
        $transaction->rollBack();
        Yii::error($e->getMessage(), __METHOD__);
        throw $e;
    }
}


public function beforeDelete()
{
    if (!parent::beforeDelete()) {
        return false;
    }

    $db = Yii::$app->db;
    $transaction = $db->beginTransaction();

    try {
        $log = new Log();
        $log->table_name = static::tableName();
$log->primary_key = $this->hasAttribute('ip')
    ? json_encode(['ip' => $this->ip], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    : json_encode($this->getPrimaryKey(true), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $log->attribute = 'DELETED';
        $log->old_value = json_encode($this->getAttributes(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $log->new_value = null;
        $log->old_date = $this->hasAttribute('date_modified') ? $this->date_modified : null;
        $log->new_date = null;
        $log->changed_by = Yii::$app->user->identity->username ?? null;
        $log->changed_at = date('Y-m-d H:i:s');

        if (!$log->save(false)) {
            Yii::error($log->getErrors(), __METHOD__);
            throw new \Exception('Αποτυχία αποθήκευσης του log διαγραφής');
        }

        $transaction->commit();
        return true;

    } catch (\Throwable $e) {
        $transaction->rollBack();
        Yii::error($e->getMessage(), __METHOD__);
        throw $e;
    }
}



       // if (!$log->save(false)) {
        //    Yii::error($log->getErrors(), __METHOD__);
        //    throw new \Exception('Αποτυχία αποθήκευσης του log');
      //  }

      //  $transaction->commit();
      //  return true;

 //  } catch (\Throwable $e) {
      //  $transaction->rollBack();
     //   Yii::error($e->getMessage(), __METHOD__);
     ///   throw $e;
  //  }
}


  



