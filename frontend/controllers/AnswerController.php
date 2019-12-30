<?php

namespace frontend\controllers;

use common\controllers\BaseEngineController;
use common\models\Answer;
use common\models\Question;
use yii\data\Pagination;
use Yii;

class AnswerController extends BaseEngineController
{
    public function actionCreate($id = NULL)
    {
        if ($id === NULL)
            return $this->redirect(['question/index', 'alert_id' => 2]);

        $answer = new Answer();
        if ($answer->load(Yii::$app->request->post()) && $answer->validate()) {
            $answer->question_id = $id;
            $answer->owner_id = Yii::$app->user->identity->attributes['id'];
            $answer->rating = 0;
            $answer->time_stamp = date('Y-m-d H:i:s');
            $hash = hash('md5', $answer->owner_id . $answer->question_id . $answer->body);
            $answer->md5_hash = $hash;
            $answer->save();
        }
        return $this->redirect(['question/view', 'id' => $id]);
    }
}
