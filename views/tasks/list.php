<?php

use yii\helpers\Url;
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
<div class="row" id="tasks">
    <div class="col-12">
        <div class="card">
            <div class="card-body"
                 :class="{ 'loading' : table.loading }"
                 v-cloak
            >
                <table class="table table-bordered table-striped hover">
                    <thead>
                    <tr>
                        <th
                                v-for="field in table.fields"
                                :style="{width: field.width + '%'}"
                        >
                            {{ field.label }}
                        </th>
                    </tr>
                    <tr>
                        <th
                                v-for="field in table.fields"
                        >

                            <input
                                    class="form-control"
                                    v-if="field.filter && field.filter.type === 'text'"
                                    :placeholder="field.filter.options.placeholder"
                                    v-model="field.filter.value"
                            >

                            <select
                                    class="form-control custom-select"
                                    v-if="field.filter && field.filter.type == 'select'"
                                    v-model="field.filter.value"
                            >
                                <option
                                        v-for="option in field.filter.options"
                                >
                                    {{ option }}
                                </option>
                            </select>
                            <button v-if="field.key == 'actions'"
                                    type="button"
                                    @click="buttonSaveFilter"
                                    class="btn btn-sm btn-soft-info  btn-circle mr-2"
                                    style="font-size: 20px;">
                                <i class="far fa-save"></i>
                            </button>
                            <button v-if="field.key == 'actions'"
                                    type="button"
                                    class="btn btn-sm btn-soft-success btn-circle mr-2"
                                    style="">
                                <i class="dripicons-search"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                            v-for="(item, index) in table.items"
                    >
                        <td
                                v-for="(cell, fieldKey) in item"
                        >
                            <p
                                    v-if="!itemEditing(index)"
                            >
                                {{ cell }}
                            </p>
                            <input
                                    v-else-if="itemEditing(index) && itemEditable(fieldKey)"
                                    class="form-control form-control-prepended"
                                    v-model="table.items[index][fieldKey]"
                                    :class="{'is-invalid': itemInvalid(fieldKey, index)}"
                            >
                            <input
                                    v-else
                                    class="form-control form-control-prepended"
                                    :class="{'is-invalid': itemInvalid(fieldKey, index)}"
                                    v-model="table.items[index][fieldKey]"
                                    disabled
                            >

                            <div
                                    v-if="itemEditing(index)"
                                    :class="{ 'invalid-feedback' : itemInvalid(fieldKey, index) }"
                                    style="height:18px"
                            >{{ itemError(fieldKey, index) }}
                            </div>
                        </td>
                        <td>
                            <!--                            Стандартные кнопки-->
                            <button
                                    v-if="!itemEditing(index)"
                                    @click="changeTask(table.itemsControls[index])"
                                    type="button" class="btn btn-sm btn-soft-success btn-circle mr-2">
                                <i class="dripicons-pencil"></i>
                            </button>
                            <button v-if="!itemEditing(index)"
                                    @click="deleteTask(item, index)"
                                    type="button" class="btn btn-sm btn-soft-danger btn-circle mr-2">
                                <i class="dripicons-trash" aria-hidden="true"></i>
                            </button>
                            <button v-if="!itemEditing(index)"
                                    @click="redirectToViewPage(index)"
                                    type="button" class="btn btn-sm btn-soft-info btn-circle">
                                <i class="dripicons-exit" aria-hidden="true"></i>
                            </button>
                            <!--                            кнопки которые открываются при редактировании-->
                            <button v-if="itemEditing(index)"
                                    @click="saveTask(item, index)"
                                    type="button"
                                    class="btn btn-sm btn-soft-purple mr-2 btn-circle"
                                    style="">
                                <i class="dripicons-checkmark"></i>
                            </button>
                            <button
                                    v-if="itemEditing(index)"
                                    @click="cancelChangeTask(index)"
                                    type="button" class="btn btn-sm btn-soft-info btn-circle" style="">
                                <i class="dripicons-cross" aria-hidden="true"></i>
                            </button>
                            <div
                                    v-if="itemEditing(index)"
                                    style="height:18px">

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="table-rep-plugin">
                    <span class="float-right">
                        <button
                                id="but_add"
                                @click="addRow"
                                class="btn btn-gradient-danger waves-effect waves-light"
                                style="color: white"
                        >Добавить задачу</button>
                    </span>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">«</span>
                                Туда</a></li>
                        <li class="page-item active"><a class="page-link " href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Сюда <span aria-hidden="true">»</span></a>
                        </li>
                    </ul><!--end pagination-->
                </nav>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<?php
$this->registerJsFile('/js/tasks/list.js', ['appendTimestamp' => true]) ?>

