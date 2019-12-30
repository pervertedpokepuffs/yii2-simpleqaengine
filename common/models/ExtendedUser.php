<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\User;

class ExtendedUser extends ActiveRecord
{
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }
}
