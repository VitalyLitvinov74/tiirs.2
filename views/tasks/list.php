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
                <b-table hover
                         :items="table.items"
                         :fields="table.fields"
                         :small="true"
                         fixed
                >
                    <template
                            #cell()="data"
                    >
                      <span v-if="!data.item.editing">
                          {{ data.value }}
<!--                          {{ data.field.key}}-->
<!--                          {{data.item}}-->
                      </span>
                        <b-input v-else v-model="table.items[data.index][data.field.key]" @keydown.enter.exact="saveTask(data.item)"></b-input>
                    </template>
                    <template
                        #cell(actions)="data"
                    >
                        <button
                                v-if="!data.item.editing"
                                @click="changeTask(data.item)"
                                type="button" class="btn btn-sm btn-soft-success btn-circle mr-2">
                            <i class="dripicons-pencil"></i>
                        </button>
                        <button v-if="!data.item.editing"
                                @click="deleteTask(data.index)"
                                type="button" class="btn btn-sm btn-soft-danger btn-circle">
                            <i class="dripicons-trash" aria-hidden="true"></i>
                        </button>
                        <button v-if="data.item.editing"
                                @click="saveTask(data.item)"
                                type="button"
                                class="btn btn-sm btn-soft-purple mr-2 btn-circle"
                                style="">
                            <i class="dripicons-checkmark"></i>
                        </button>
                        <button
                                v-if="data.item.editing"
                                @click="cancelChangeTask(data.item)"
                                type="button" class="btn btn-sm btn-soft-info btn-circle" style="" >
                            <i class="dripicons-cross" aria-hidden="true"></i>
                        </button>
                    </template>
                </b-table>
                <div class="table-rep-plugin">
                    <span class="float-right">
                        <button
                                id="but_add"
                                @click="addTask"
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
$this->registerJs(<<<JS
   new Vue({
        el: "#tasks",
        data: function(){
            return {
                table: {
                    fields:[
                        /**
                        * editable: true | false - получаем от бека. 
                        * */
                        {key: "task", label: "Задача", editable: true},
                        {key: "worker", label: "Лицо-участник для решения задачи", editable: true},
                        //thClass: 'd-none', tdClass: 'd-none' скрывает колонку.
                        {key: "taskDate", label: "Дата постановки задачи", editable: true, },
                        {key: "dateExpired", label: "Задача выполнена к", editable: true},
                        {key: "result", label: "Результат", editable: true},
                        {key: "time", label: "Затраченное время", editable: true},
                        {key: "report", label: "Отчет", editable: true},
                        {key: "actions", label: "Действие"},
                        
                    ],
                    items: [
                      { task: 40, worker: 'Dickerson', last_name: 'Macdonald' },
                      { task: 21, worker: 'Larsen', last_name: 'Shaw' },
                      { task: 89, worker: 'Geneva', last_name: 'Wilson' },
                      { task: 38, worker: 'Jami', last_name: 'Carney' }
                    ] 
                }
                
            }
        },
        mounted: function(){
            this.table.items = this.table.items.map(item => ({...item, editing: false}));
        },
        methods:{

            /**
             * Сохарняет измененную задачу.
             * */
            saveTask: function(item){
                item.editing = false;
            },

            /**
             * обрабатывает кнопку "добавить задачу".
             */
            addTask: function(){
                let item = {
                    editing: false
                };
                this.table.items.push(item);
                this.changeTask(item);
            },
            
            changeTask: function(item){
                 this.cancelAllChangeTask();
                item.editing = true;
                
            },
            
            cancelChangeTask: function(item){
                console.log(item);
                item.editing = false;
            },
            
            cancelAllChangeTask: function(){
                this.table.items.map(function (otherItem){
                    otherItem.editing = false;
                });
                
            },
            
            deleteTask: function(index){
                this.table.items.splice(index, 1);
            }
        }
        
    });
JS
); ?>

