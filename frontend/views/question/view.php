<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $question['question']['title'];
$this->params['breadcrumbs'][] = 'Question: ' . $this->title;
?>

<div class="container-fluid">
    <div class="container-fluid py-3">
        <div class="card">
            <div class="container-fluid p-1 pt-3">
                <div class="container-fluid">
                    <div class="media justify-content-start">
                        <div class="px-5">
                            <h1><? echo $question['question']['rating'] ?></h1>
                        </div>
                        <div class="media-body">
                            <div class="d-flex flex-row">
                                <h4><? echo $question['question']['title'] ?></h4>
                                <? if (Yii::$app->user->identity->attributes['id'] === $question['question']['owner_id']) : ?>
                                    <a class="ml-2" href="<? echo Url::to(['question/edit', 'id' => $id]) ?>">
                                        <h6>(edit)</h6>
                                    </a>
                                    <a class="ml-2 text-danger" href="<? echo Url::to(['question/remove', 'id' => $id]) ?>"><h6>(remove)</h6></a>
                                <? endif ?>
                            </div>
                            <p><? echo $question['question']['body'] ?></p>
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

<div class="container-fluid">
    <h3>Answers</h3>

    <div class="container-fluid">
        <? $form = ActiveForm::begin([
            'action' => ['answer/create', 'id' => $id],
            'layout' => 'horizontal'
        ]) ?>
        <? echo $form->field($answer_model, 'body', [
            'enableLabel' => false,
            'horizontalCssClasses' => [
                'wrapper' => 'col'
            ]
        ])->textarea(['placeholder' => 'Create new answer']) ?>
        <div class="row form-group justify-content-end">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>
        <? ActiveForm::end() ?>
    </div>

    <?php foreach ($answers as $answer) : ?>
        <div class="container-fluid py-3">
            <div class="card">
                <div class="container-fluid p-1 pt-3">
                    <div class="container-fluid">
                        <div class="media justify-content-start">
                            <div class="px-5">
                                <h1><? echo $answer['answer']['rating'] ?></h1>
                            </div>
                            <div class="media-body">
                                <p><? echo $answer['answer']['body'] ?></p>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="media align-items-end">
                                <div class="px-3">
                                    <img src="<? echo $answer['user']['profile_img'] ?>" class="img-thumbnail rounded" height=48 width=48 />
                                </div>
                                <div class="media-body">
                                    <h5><? echo $answer['user']['username'] ?></h5>
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <h6><? echo 'Answered on ' . $answer['answer']['time_stamp'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach ?>
</div>