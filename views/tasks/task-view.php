<?php
/**
 * @var \yii\web\View $this
 */

use yii\helpers\Url; ?>
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Главная</a></li>
                    <li class="breadcrumb-item"><a href="<?=Url::toRoute(['tasks/list'])?>">Список задач</a></li>
                    <li class="breadcrumb-item active">Задача 24</li>
                </ol>
            </div>
            <h4 class="page-title">Просмотр задачи</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<!-- end page title end breadcrumb -->
<div class="row">
    <div class="col-lg-4">
        <?=$this->render('task-view/timeline')?>
    </div><!--end col-->
    <div class="col-lg-8">
        <?=$this->render('task-view/description')?>
        <?=$this->render('task-view/mapbox')?>
    </div><!--end col-->

</div><!--end row-->
