<?php

use app\assets\TableAssets;
use yii\web\View;

/**
 * @var View $this
 */
//TableAssets::register($this);
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
                        <table id="makeEditable" class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th data-priority="2">Задача</th>
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
                                <td style="width:200px">GOOG Google Inc.</td>
                                <td>597.74</td>
                                <td>12:12PM</td>
                                <td>14.81 (2.54%)</td>
                                <td>582.93</td>
                                <td>597.73 x 100</td>
                                <td>597.91 x 300</td>
                                <td name="buttons">
                                    <div class=" pull-right">
                                        <button
                                                id="bEdit"
                                                type="button"
                                                class="btn btn-sm btn-soft-success btn-circle mr-2"
                                                style="" onclick="rowEdit(this);"><i class="dripicons-pencil">

                                            </i>
                                        </button>
                                        <button
                                                id="bElim"
                                                type="button"
                                                class="btn btn-sm btn-soft-danger btn-circle"
                                                style="" onclick="rowElim(this);">
                                            <i class="dripicons-trash" aria-hidden="true"></i>
                                        </button>
                                        <button id="bAcep"
                                                type="button"
                                                class="btn btn-sm btn-soft-purple mr-2 btn-circle"
                                                @click="saveTask()"
                                                onclick="rowAcep(this)" style="display: none;">
                                            <i class="dripicons-checkmark"></i>
                                        </button>
                                        <button
                                                id="bCanc"
                                                type="button"
                                                class="btn btn-sm btn-soft-info btn-circle"
                                                onclick="rowCancel(this);" style="display: none;">
                                            <i class="dripicons-cross" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>GOOG</td>
                                <td>597.74</td>
                                <td>12:12PM</td>
                                <td>14.81 (2.54%)</td>
                                <td>582.93</td>
                                <td>597.73 x 100</td>
                                <td>597.91 x 300</td>
                                <td name="buttons">
                                    <div class=" pull-right">
                                        <button
                                                id="bEdit"
                                                type="button"
                                                class="btn btn-sm btn-soft-success btn-circle mr-2"
                                                style="" onclick="rowEdit(this);"><i class="dripicons-pencil">

                                            </i>
                                        </button>
                                        <button
                                                id="bElim"
                                                type="button"
                                                class="btn btn-sm btn-soft-danger btn-circle"
                                                style="" onclick="rowElim(this);">
                                            <i class="dripicons-trash" aria-hidden="true"></i>
                                        </button>
                                        <button id="bAcep"
                                                type="button"
                                                class="btn btn-sm btn-soft-purple mr-2 btn-circle"
                                                @click="saveTask()"
                                                onclick="rowAcep(this)" style="display: none;">
                                            <i class="dripicons-checkmark"></i>
                                        </button>
                                        <button
                                                id="bCanc"
                                                type="button"
                                                class="btn btn-sm btn-soft-info btn-circle"
                                                onclick="rowCancel(this);" style="display: none;">
                                            <i class="dripicons-cross" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <span class="float-right">
                        <button
                                id="but_add"
                                @click="addTask"
                                class="btn btn-gradient-danger waves-effect waves-light"
                        >Добавить задачу</button>
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
        methods:{

            /**
             * Сохарняет измененную задачу.
             * */
            saveTask: function(){
                console.log('hello')
            },

            /**
             * обрабатывает кнопку "добавить задачу".
             */
            addTask: function(){
                
            }
        }
    });
JS
); ?>

