<?php

use yii\web\View;
/**
 * @var View $this
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
<div class="row" id="tasks">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

<!--                <h4 class="mt-0 header-title">План работ на неделю с 08.11.2021 - 12.11.2021</h4>-->
<!--                <p class="text-muted mb-3">План работ с 08.11.2021 - 12.11.2021</p>-->

                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th data-priority="1">Задача</th>
                                <th data-priority="6">Лицо-участник для решения задачи</th>
<!--                                <th data-priority="3">Автор</th>-->
                                <th data-priority="6">Дата постановки задачи</th>
                                <th data-priority="6">Задача выполнена к</th>
                                <th data-priority="6">Затраченное время</th>
                                <th data-priority="3">Результат</th>
                                <th data-priority="3">Отчет</th>
                            </tr>
                            </thead>
                            <tbody class="table-striped">
                            <tr>
                                <th>GOOG <span class="co-name">Google Inc.</span></th>
                                <td>597.74</td>
                                <td>12:12PM</td>
                                <td>14.81 (2.54%)</td>
                                <td>582.93</td>
                                <td>597.73 x 100</td>
                                <td>597.91 x 300</td>
                                <td>
                                    <a href="#" class="mr-2"><i class="fas fa-edit text-info font-16"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt text-danger font-16"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <span class="float-right">
                        <button id="but_add" class="btn btn-gradient-danger waves-effect waves-light">Добавить задачу</button>
                    </span>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<?php
    $this->registerJs(<<<JS
    new Vue({
        el: "#tasks",
        data: {},
        mounted: function(){
            
        },
        methods:{
            
        }
    });
JS
);?>
