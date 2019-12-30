<?php
$this->title = $question['question']['title'];
$this->params['breadcrumbs'][] = 'Question: ' . $this->title;
?>

<div class="container-fluid">
    <div class="container-fluid py-3">
        <div class="card bg-secondary text-white">
            <div class="container-fluid p-1">
                <div class="container-fluid">
                    <div class="media justify-content-start">
                        <div class="px-5">
                            <h1><? echo $question['question']['rating'] ?></h1>
                        </div>
                        <div class="media-body">
                            <h4><? echo $question['question']['title'] ?></h4>
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
    <?php foreach ($answers as $answer) : ?>
        <div class="container-fluid py-3">
            <div class="card">
                <div class="container-fluid p-1">
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