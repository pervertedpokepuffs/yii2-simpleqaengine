<?php

namespace common\controllers;

use yii\web\Controller;
use common\models\Question;
use common\models\Answer;
use common\models\User;
use common\models\ExtendedUser;

class BaseQuestionController extends Controller
{
    public function _get_user_details($user_id)
    {
        $extended_user = ExtendedUser::find()
            ->select('profile_img')
            ->where(['owner_id' => $user_id])
            ->one();
        $user = User::find()
            ->select('username')
            ->where(['id' => $user_id])
            ->one();

        $user_details['username'] = $user->attributes['username'];
        $user_details['profile_img'] = $extended_user->attributes['profile_img'];
        return $user_details;
    }
}
