<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\Answer;

class Question extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title', 'body'], 'required']
        ];
    }
    
    public function getAnswer()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'question_id']);
    }
}
