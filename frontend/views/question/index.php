<?php

use yii\helpers\Url;
use yii\bootstrap4\LinkPager;

$this->title = 'Simple QA Engine';
?>

<div class="container-fluid">
    <?php foreach ($data as $data_item) : ?>
        <div class="container-fluid py-3">
            <div class="card">
                <div class="container-fluid p-1">
                    <div class="container-fluid">
                        <div class="media justify-content-start">
                            <div class="px-5">
                                <h1><? echo $data_item['question']['rating'] ?></h1>
                            </div>
                            <div class='media-body'>
                                <h4><a href="<? echo Url::toRoute(['view', 'id' => $data_item['question']['question_id']]); ?>"><? echo $data_item['question']['title'] ?></a></h4>
                                <p><? echo $data_item['question']['body'] ?></p>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="media align-items-end">
                                <div class="pr-3">
                                    <img src="<? echo $data_item['user']['profile_img'] ?>" class="img-thumbnail rounded" height=48 width=48 />
                                </div>
                                <div class="media-body">
                                    <h5><? echo $data_item['user']['username'] ?></h5>
                                </div>
                            </div>

                            <div class="d-flex flex-row">
                                <h6><? echo 'Asked on ' . $data_item['question']['time_stamp'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach ?>
    <? echo LinkPager::widget(['pagination' => $pagination, 'disableCurrentPageButton' => true]); ?>
</div>