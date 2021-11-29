<?php
/**
 * @var \yii\web\View $this
*/

$this->registerJsFile('/js/filters/list.js', ['appendTimestamp' => true])
?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Главная</a></li>
                    <!--                    <li class="breadcrumb-item"><a href="javascript:void(0);">Задачи</a></li>-->
                    <li class="breadcrumb-item active"><?= $this->title ?></li>
                </ol>
            </div>
            <h4 class="page-title"><?= $this->title ?></h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<!-- end page title end breadcrumb -->
<div class="row" id="filters">
    <div class="col-3">
        <div class="card">
            <div class="card-body">

                <div class="text-center project-card">
                    <img src="/images/widgets/p-2.svg" alt="" height="80" class="mx-auto d-block mb-3">
                    <span class="badge badge-soft-info font-11">Задачи</span>
                    <h3 class="project-title ">Текущий день</h3>
                    <p class="text-muted"><span class="text-secondary font-14"><b>Фильтр включает в себя следующие данные :</b></span>
                        <table class="table table-bordered table-striped hover">

                            <tbody>
                                <tr>
                                    <td>Срок выполнения</td>
                                    <td>Текущий день</td>
                                </tr>
                            </tbody>
                        </table>

                    </p>
                    <button type="button" class="btn btn-gradient-purple waves-effect waves-light mr-4">Перейти</button>
                    <button type="button" class="btn btn-gradient-danger waves-effect waves-light">Удалить</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">

            <div class="card-body">

                <div class="text-center project-card">
                    <img src="/images/widgets/p-2.svg" alt="" height="80" class="mx-auto d-block mb-3">
                    <span class="badge badge-soft-info font-11">Задачи</span>
                    <h3 class="project-title ">Текущая неделя</h3>
                    <p class="text-muted"><span class="text-secondary font-14"><b>Фильтр включает в себя следующие данные :</b></span>
                    <table class="table table-bordered table-striped hover">

                        <tbody>
                        <tr>
                            <td>Срок выполнения</td>
                            <td>Текущая неделя</td>
                        </tr>
                        </tbody>
                    </table>

                    </p>
                    <button type="button" class="btn btn-gradient-purple waves-effect waves-light mr-4">Перейти</button>
                    <button type="button" class="btn btn-gradient-danger waves-effect waves-light">Удалить</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">

                <div class="text-center project-card">
                    <img src="/images/widgets/p-2.svg" alt="" height="80" class="mx-auto d-block mb-3">
                    <span class="badge badge-soft-info font-11">Задачи</span>
                    <h3 class="project-title ">За текщий год</h3>
                    <p class="text-muted"><span class="text-secondary font-14"><b>Фильтр включает в себя следующие данные :</b></span>
                    <table class="table table-bordered table-striped hover">

                        <tbody>
                        <tr>
                            <td>Срок выполнения</td>
                            <td>Текущий год</td>
                        </tr>
                        </tbody>
                    </table>

                    </p>
                    <button type="button" class="btn btn-gradient-purple waves-effect waves-light mr-4">Перейти</button>
                    <button type="button" class="btn btn-gradient-danger waves-effect waves-light">Удалить</button>
                </div>
            </div>
        </div>
    </div>
</div>


