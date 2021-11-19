<?php
/**
 * @var \yii\web\View $this
 */
?>
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Crovex</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">UI Kit</a></li>
                    <li class="breadcrumb-item active">Responsive</li>
                </ol>
            </div>
            <h4 class="page-title">Responsive Table</h4>
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
