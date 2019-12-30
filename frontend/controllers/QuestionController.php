<?php

namespace frontend\controllers;

use common\controllers\BaseEngineController;
use common\models\Answer;
use common\models\Question;
use yii\data\Pagination;
use Yii;

class QuestionController extends BaseEngineController
{
    public function actionIndex($alert_id = false)
    {
        if ($alert_id)
            $alert = $this->_get_alert_message($alert_id);
        $data = [];
        $query = Question::find();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $questions = $query->orderBy(['time_stamp' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        foreach ($questions as $question) {
            $temp_data['user'] = $this->_get_user_details($question->attributes['owner_id']);
            $temp_data['question'] = $question->attributes;
            array_push($data, $temp_data);
        }

        $this->view->params['alert'] = $alert;

        return $this->render('index', ['data' => $data, 'pagination' => $pagination]);
    }

    public function actionView($id, $alert_id = false)
    {
        if ($alert_id)
            $alert = $this->_get_alert_message($alert_id);
        $answer_data = [];
        $question = Question::find()
            ->where(['question_id' => $id])
            ->one();
        $answers = Answer::find()
            ->where(['question_id' => $id])
            ->orderBy(['rating' => SORT_DESC])
            ->all();

        $answer_model = new Answer();

        $question_data['user'] = $this->_get_user_details($question->attributes['owner_id']);
        $question_data['question'] = $question->attributes;

        foreach ($answers as $answer) {
            $temp_data['user'] = $this->_get_user_details($answer->attributes['owner_id']);
            $temp_data['answer'] = $answer->attributes;
            array_push($answer_data, $temp_data);
        }

        $this->view->params['alert'] = $alert;

        return $this->render('view', ['id' => $id, 'question' => $question_data, 'answers' => $answer_data, 'answer_model' => $answer_model]);
    }

    public function actionEdit($id)
    {
        $question = Question::find()
            ->where(['question_id' => $id])
            ->one();

        $question_data['user'] = $this->_get_user_details($question->attributes['owner_id']);
        $question_data['question'] = $question->attributes;

        if (Yii::$app->user->identity->attributes['id'] !== $question->attributes['owner_id'])
            return $this->redirect(['question/index', 'alert_id' => 401]);

        if ($question->load(Yii::$app->request->post()) && $question->validate()) {
            $question->save();

            return $this->redirect(['question/view', 'id' => $id, 'alert_id' => 200]);
        } else
            return $this->render('edit', ['id' => $id, 'question' => $question_data, 'model' => $question]);
    }

    public function actionRemove($id)
    {
        $question = Question::find()
            ->where(['question_id' => $id])
            ->one();

        if (Yii::$app->user->identity->attributes['id'] !== $question->attributes['owner_id'])
            return $this->redirect(['question/index', 'alert_id' => 401]);

        $question->delete();
        return $this->redirect(['question/index', 'alert_id' => 204]);
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest)
            return $this->redirect(['question/index', 'alert_id' => 401]);

        $question = new Question();

        $user = Yii::$app->user->identity->attributes;

        $question_data['user'] = $this->_get_user_details($user['id']);

        if ($question->load(Yii::$app->request->post()) && $question->validate()) {
            $question->owner_id = $user['id'];
            $question->rating = 0;
            $question->time_stamp = date('Y-m-d H:i:s');
            $hash = hash('md5', $question->owner_id . $question->body);
            $question->md5_hash = $hash;
            $question->save();
            $id = $question->question_id;

            return $this->redirect(['question/view', 'id' => $id, 'alert_id' => 200]);
        } else
            return $this->render('create', ['id' => $id, 'question' => $question_data, 'model' => $question]);
    }
}
