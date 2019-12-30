<?php

namespace common\controllers;

use yii\web\Controller;
use common\models\Question;
use common\models\Answer;
use common\models\User;
use common\models\ExtendedUser;

class BaseEngineController extends Controller
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

    public function _get_alert_message($alert_id)
    {
        switch ($alert_id) {
            case 200:
                return ['class' => 'alert-success', 'message' => '200 Successfully created/updated.'];
            case 204:
                return ['class' => 'alert-success', 'message' => '204 Successfully deleted.'];

            case 401:
                return ['class' => 'alert-danger', 'message' => '401 Unauthorized.'];
            default:
                return ['class' => 'alert-danger', 'message' => 'Unknown error'];
        }
    }
}
