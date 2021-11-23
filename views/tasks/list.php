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
                <b-table hover
                         :items="table.items"
                         :fields="table.fields"
                         fixed
                >
                    <template
                            #cell()="data"
                            :class="{ 'loading' : data.item.loading }"
                            v-cloak
                    >
                      <span v-if="!data.item.editing || !data.field.editable">
                          {{ data.value }}
<!--                                                    {{ data.field}}-->
                          <!--                          {{data.item}}-->
                      </span>
                        <div v-else-if="data.field.editable === true">
                            <b-input
                                    v-model="table.items[data.index][data.field.key]"
                                     @keydown.enter.exact="saveTask(data.item)"
                                    :class="{ 'is-invalid' : data.item.errors[data.field.key]}"
                            ></b-input>
                            <div class="invalid-feedback">{{ data.item.errors[data.field.key] }}</div>
                        </div>
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
                                @click="deleteTask(data.item, data.index)"
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
                                type="button" class="btn btn-sm btn-soft-info btn-circle" style="">
                            <i class="dripicons-cross" aria-hidden="true"></i>
                        </button>
                    </template>
                </b-table>
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
$updateProblemUrl = \yii\helpers\Url::toRoute(['problems/problems/update-problem']);
$addTaskUrl = \yii\helpers\Url::toRoute(['problems/problems/add-problem']);
$tasksUrl = \yii\helpers\Url::toRoute(['problems/problems/problems']);
$deleteUrl = Url::toRoute(['problems/problems/delete-problem']);
$this->registerJs(<<<JS
   new Vue({
        el: "#tasks",
        data: function(){
            return {
                table: {
                    fields: null, //см. метод fields
                    items: null, // см. метод items
                    loading: true
                },
                
                
            }
        },
        mounted: function(){
            this.loadTable();
        },
        methods:{
            
            loadTable: function(){
                let self = this;
                axios({
                    method: "get",
                    url: "$tasksUrl",
                    headers: {"Content-Type":"application/json"}
                })
                .then(function(response){
                    let data = response.data.data;
                    if(data.length === 0){
                        return;    
                    }
                    self.table.fields = self.fields(data[0].attributes.mappedKeys);
                    self.table.items = self.items(data);
                    self.table.loading = false;
                })
                .catch(function(error){
                    console.log(error.data);
                    self.table.loading = false;
                });
            },
            
            /**
            * Создает структуру таблицы на основе ответа от бэкэнда.
            * @param axiosMappedKeys
            */
            fields: function(axiosMappedKeys){
                return [
                    {key: "id", label: axiosMappedKeys.id},
                    {key: "description", label: axiosMappedKeys.description, editable: true},
                    {key: "status", label: axiosMappedKeys.status, editable: true},
                    {key: "time_of_creation", label: axiosMappedKeys.time_of_creation},
                    {key: "period_of_execution", label: axiosMappedKeys.period_of_execution, editable: true},
                    {key: "actions", label: "Действие"},
                ]
            },
            
            /**
            * заполняет таблицу на основе ответа от бека
            * @param axiosTasks
            * @return {*}
            */
            items: function(axiosTasks){
                let self = this;
                return axiosTasks.map(function(task){
                    let attr = task.attributes;
                    return {
                        id: task.id,
                        description: attr.description,
                        status: attr.status,
                        time_of_creation: self.convertTime(attr.time_of_creation),
                        period_of_execution: self.convertTime(attr.period_of_execution),
                        editing: false, // редактируется ли этот элемент в текущий момент
                        new: false, //указывает новый ли это элемент
                        loading: false,
                        errors: {} //ошибки редактирования если они есть.
                    };
                });
            },
            
            /**
            * Преобразует дату из timestamp в дд.мм.гггг (чч:мм)
            * */
            convertTime: function(timestamp){
                return moment(timestamp * 1000, 'x').format('DD.MM.YYYY (HH:mm)');
            },

            /**
             * Сохарняет измененную задачу.
             * */
            saveTask: function(item){
                item.loading = true;
                if(item.new){
                    this.saveNewTask(item);
                    return;
                }
                let itemData = item;
                let self = this;
                axios({
                    method: "POST",
                    url: "$updateProblemUrl",
                    data: itemData,
                    headers: {"Content-Type":"application/json"}
                })
                .then(function(response){
                    let data = response.data.data;
                    itemData.status = data.attributes.status;
                    itemData.timeOfCreation = data.attributes.time_of_creation;
                    itemData.periodOfExecution = data.attributes.period_of_execution;
                    item.editing = false;
                })
                .catch(function (error){
                    console.log(error.data);
                });
            },
            
            saveNewTask: function(item){
                item.new = false;
                axios({
                    method: "POST",
                    url: "$addTaskUrl",
                    data: item,
                    headers: {"Content-Type":"application/json"}
                })
                .then(function(body){
                    let data = body.data.data; 
                    item.editing = false;
                    item.loading = false;
                })
                .catch(function (body){
                    let axiosError = body.response.data;
                    if(axiosError.hasOwnProperty('errors')){ //сработало исключение, ошибка валидна
                        let errors = axiosError.errors;
                        if(errors.find(error => error.title === "author_id")){
                               console.log('Ошибка авторизации')//Ошибка авторизации
                        }
                        for (let error in errors){
                            item.errors[errors[error].title] = errors[error].description
                        }
                        
                        //вывести ошибку на поля формы.
                    }else{ //произошла неизвестная ошибка
                       
                    }
                    item.loading = false;
                });
            },
            
            setErrorsToRow: function(item){
                
            },

            /**
             * обрабатывает кнопку "добавить задачу".
             */
            addRow: function(){
                let item = {
                    editing: false,
                    new: true,
                    loading: false,
                    errors: {}
                };
                this.table.items.push(item);
                this.changeTask(item);
            },
            
            changeTask: function(item){
                this.cancelAllChangeTask();
                item.editing = true;
                
            },
            
            cancelChangeTask: function(item){
                item.editing = false;
            },
            
            cancelAllChangeTask: function(){
                this.table.items.map(function (otherItem){
                    otherItem.editing = false;
                });
                
            },
            
            /**
            * @param item - сам элемент откуда берем ид для удаления данных.
            * @param index - номер элемента в массиве (в таблице на фронте)
            * */
            deleteTask: function(item, index){
                axios({
                    method: "POST",
                    url: "$deleteUrl",
                    data: {id: item.id},
                    headers: {"Content-Type":"application/json"}
                })
                .then(function(response) {
                    this.table.items.splice(index, 1);
                })
                .catch(function(error){
                    //вывести предупреждение что не удалось удалить.
                    error.data;
                });
                
            }
        }
        
    });
JS
); ?>

