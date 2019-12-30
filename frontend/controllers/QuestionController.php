<?php

namespace frontend\controllers;

use common\controllers\BaseQuestionController;
use common\models\Answer;
use common\models\Question;
use yii\data\Pagination;
use Yii;
use yii\helpers\Url;

class QuestionController extends BaseQuestionController
{
    public function actionIndex()
    {
        $data = [];
        $breadcrumbs = [
            ['label' => 'Home']
        ];
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

        return $this->render('index', ['data' => $data, 'pagination' => $pagination]);
    }

    public function actionView($id)
    {
        $answer_data = [];
        $question = Question::find()
            ->where(['question_id' => $id])
            ->one();
        $answers = Answer::find()
            ->where(['question_id' => $id])
            ->orderBy(['rating' => SORT_DESC])
            ->all();

        $question_data['user'] = $this->_get_user_details($question->attributes['owner_id']);
        $question_data['question'] = $question->attributes;

        foreach ($answers as $answer) {
            $temp_data['user'] = $this->_get_user_details($answer->attributes['owner_id']);
            $temp_data['answer'] = $answer->attributes;
            array_push($answer_data, $temp_data);
        }

        return $this->render('view', ['question' => $question_data, 'answers' => $answer_data]);
    }

    public function actionEdit($id)
    {
        $question = Question::find()
            ->where(['question_id' => $id])
            ->one();

        $question_data['user'] = $this->_get_user_details($question->attributes['owner_id']);
        $question_data['question'] = $question->attributes;

        if (Yii::$app->user->identity->attributes['id'] !== $question->attributes['owner_id'])
            return $this->redirect(['question/index']);

        if ($question->load(Yii::$app->request->post()) && $question->validate())
        {
            $question->save();

            return $this->redirect(['question/view', 'id' => $id]);
        }
        else
            return $this->render('edit', ['id' => $id, 'question' => $question_data, 'model' => $question]);
    }
}
