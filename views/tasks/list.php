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
            <div class="card-body"
                 :class="{ 'loading' : table.loading }"
                 v-cloak
            >
                <table class="table table-bordered table-striped hover">
                    <thead>
                    <th v-for="field in table.fields">
                        {{ field.label }}
                    </th>
                    </thead>
                    <tbody>
                    <tr v-for="(item, index) in table.items">
                        <td v-for="(cell, fieldKey) in item">
                            <p
                                    v-if="!itemEditing(index)"
                            >
                                {{ cell }}
                            </p>
                            <input
                                    v-else-if="itemEditing(index) && itemEditable(fieldKey)"
                                    class="form-control form-control-prepended"
                                    v-model="table.items[index][fieldKey]"
                            >
                            <input
                                    v-else
                                    class="form-control form-control-prepended"
                                    v-model="table.items[index][fieldKey]"
                                    disabled
                            >
                        </td>
                        <td>
                            <button
                                    v-if="!itemEditing(index)"
                                    @click="changeTask(table.itemsControls[index])"
                                    type="button" class="btn btn-sm btn-soft-success btn-circle mr-2">
                                <i class="dripicons-pencil"></i>
                            </button>
                            <button v-if="!itemEditing(index)"
                                    @click="deleteTask(item, index)"
                                    type="button" class="btn btn-sm btn-soft-danger btn-circle">
                                <i class="dripicons-trash" aria-hidden="true"></i>
                            </button>
                            <button v-if="itemEditing(index)"
                                    @click="saveTask(item)"
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

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<?php
$this->registerJsFile('/js/tasks/list.js', ['appendTimestamp' => true]) ?>

