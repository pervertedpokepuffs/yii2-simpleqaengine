<?php

namespace frontend\controllers;

use common\controllers\BaseQuestionController;
use common\models\Answer;
use common\models\Question;

class QuestionController extends BaseQuestionController
{
    public function actionIndex()
    {
        $data =[];
        $questions = Question::find()
            ->orderBy(['time_stamp' => SORT_DESC])
            ->all();

        foreach($questions as $question)
        {
            $temp_data['user'] = $this->_get_user_details($question->attributes['owner_id']);
            $temp_data['question'] = $question->attributes;
            array_push($data, $temp_data);
        }
        
        return $this->render('index', ['data' => $data]);
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

        foreach($answers as $answer)
        {
            $temp_data['user'] = $this->_get_user_details($answer->attributes['owner_id']);
            $temp_data['answer'] = $answer->attributes;
            array_push($answer_data, $temp_data);
        }

        return $this->render('view', ['question' => $question_data, 'answers' => $answer_data]);
    }
}
