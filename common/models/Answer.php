<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\models\Question;

class Answer extends ActiveRecord
{
    public function rules()
    {
        return [
            [['body'], 'required']
        ];
    }

    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['question_id' => 'question_id']);
    }
}
