<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\Question;
use common\models\Answer;
use common\models\ExtendedUser;

use common\tests\fixtures\data\AnswerData;
use common\tests\fixtures\data\ExtendedUserData;
use common\tests\fixtures\data\QuestionData;

class SeedController extends Controller
{
    public function actionIndex()
    {
        $data['answer'] = AnswerData::get_data();
        $data['question'] = QuestionData::get_data();
        $data['euser'] = ExtendedUserData::get_data();

        foreach ($data['euser'] as $euser) {
            $extendeduser = new ExtendedUser();

            $extendeduser->setIsNewRecord(true);
            $extendeduser->owner_id = $euser['owner_id'];
            $extendeduser->about_me = $euser['about_me'];
            $extendeduser->profile_img = $euser['profile_img'];

            $check = ExtendedUser::find()
                ->where(['owner_id' => $euser['owner_id']])
                ->count();
            if (!$check)
                $extendeduser->save();
        }

        foreach ($data['question'] as $questiondata) {
            $question = new Question();

            $question->setIsNewRecord(true);
            $question->owner_id = $questiondata['owner_id'];
            $question->title = $questiondata['title'];
            $question->body = $questiondata['body'];
            $question->rating = $questiondata['rating'];
            $question->time_stamp = $questiondata['timestamp'];
            $hash = hash('md5', $questiondata['owner_id'] . $questiondata['body']);
            $question->md5_hash = $hash;

            $check = Question::find()
                ->where(['md5_hash' => $hash])
                ->count();
            if (!$check)
                $question->save();
        }

        foreach ($data['answer'] as $answerdata) {
            $answer = new Answer();

            $answer->setIsNewRecord(true);
            $answer->owner_id = $answerdata['owner_id'];
            $answer->question_id = $answerdata['question_id'];
            $answer->body = $answerdata['body'];
            $answer->rating = $answerdata['rating'];
            $answer->time_stamp = $answerdata['timestamp'];
            $hash = hash('md5', $answerdata['owner_id'] . $answerdata['question_id'] . $answerdata['body']);
            $answer->md5_hash = $hash;

            $check = Answer::find()
                ->where(['md5_hash' => $hash])
                ->count();
            if (!$check)
                $answer->save();
        }
    }
}
