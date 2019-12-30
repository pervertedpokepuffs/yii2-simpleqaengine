<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $question['question']['title'];
$this->params['breadcrumbs'] = [
    [
        'label' => 'Create Question'
    ]
];
?>

<div class="container-fluid">
    <div class="container-fluid py-3">
        <div class="card">
            <div class="container-fluid p-1">
                <div class="container-fluid">
                    <div class="media justify-content-start">
                        <div class="px-5">
                            <h1><? echo $question['question']['rating'] ?></h1>
                        </div>
                        <div class="media-body">
                            <div class="container-fluid">
                                <? $form = ActiveForm::begin([
                                    'action' => ['question/create'],
                                    'layout' => 'horizontal'
                                ]); ?>
                                <? echo $form->field($model, 'title')->textInput(); ?>
                                <? echo $form->field($model, 'body')->textarea(); ?>
                                <div class="form-group row justify-content-end">
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                                </div>
                                <? ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="media align-items-end">
                            <div class="px-3">
                                <img src="<? echo $question['user']['profile_img'] ?>" class="img-thumbnail rounded" height=48 width=48 />
                            </div>
                            <div class="media-body">
                                <h5><? echo $question['user']['username'] ?></h5>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <h6><? echo 'Asked on ' . $question['question']['time_stamp'] ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>