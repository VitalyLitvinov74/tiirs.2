new Vue({
    el: "#tasks",
    data: function(){
        return {
            table: {
                fields: null, //см. метод fields
                items: null, // см. метод items,
                itemsControls: null,
                loading: true
            },
            rowData: {}
        }
    },
    mounted: function(){
        this.loadTable();
    },
    computed: {

    },
    methods:{

        loadTable: function(){
            let self = this;
            axios({
                method: "get",
                url: "/problems/problems/problems",
                headers: {"Content-Type":"application/json"}
            })
                .then(function(response){
                    let data = response.data.data;
                    if(data.length === 0){
                        return;
                    }
                    self.table.fields = self.fields(data[0].attributes.mappedKeys);
                    self.table.items = self.items(data);
                    self.table.itemsControls = self.itemsControls(data);
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
                };
            });
        },

        /**
         * Дополнительные данные по каждой строке.
         * */
        itemsControls(axiosTasks){
            let self = this;
            return axiosTasks.map(function (task){
                return self.defaultItemControl();
            });
        },

        itemEditing: function (index){
            return this.table.itemsControls[index].editing;
        },

        itemEditable: function(fieldKey){
            return this.table.fields.find(function(field){
                return field.key === fieldKey && field.editable === true;
            });
        },

        defaultItemControl: function(){
            return {
                editing: false, // редактируется ли строка  в текущий момент
                new: false, //указывает новая ли это строка
                loading: false,
                errors: {} //ошибки редактирования если они есть.
            };
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
                url: "/problems/problems/update-problem",
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
                url: "/problems/problems/add-problem",
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
                        console.log(item);
                        //вывести ошибку на поля формы.
                    }else{ //произошла неизвестная ошибка

                    }
                    item.loading = false;
                });
        },

        /**
         * обрабатывает кнопку "добавить задачу".
         */
        addRow: function(){
            this.table.items.push(
                {
                    id: null,
                    description: null,
                    status: null,
                    time_of_creation: null,
                    period_of_execution: null,
                }
            );
            let itemControl = this.defaultItemControl();
            this.table.itemsControls.push(itemControl);
            this.changeTask(itemControl);
        },

        changeTask: function(itemControl){
            this.cancelAllChangeTask();
            itemControl.editing = true;
        },

        cancelChangeTask: function(index){
            this.table.itemsControls[index].editing = false;
        },

        cancelAllChangeTask: function(){
            this.table.itemsControls.map(function (itemControl){
                itemControl.editing = false;
            });

        },

        /**
         * @param item - сам элемент откуда берем ид для удаления данных.
         * @param index - номер элемента в массиве (в таблице на фронте)
         * */
        deleteTask: function(item, index){
            axios({
                method: "POST",
                url: "/problems/problems/delete-problem",
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