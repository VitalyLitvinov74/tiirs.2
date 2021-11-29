//todo нужно добавить динамичности. (лоадеры)
new Vue({
    el: "#tasks",
    data: function () {
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
    mounted: function () {
        this.loadTable();
    },
    computed: {},
    methods: {

        loadTable: function () {
            let self = this;
            axios({
                method: "get",
                url: "/problems/problems/problems",
                headers: {"Content-Type": "application/json"}
            })
                .then(function (response) {
                    let data = response.data.data;
                    if (data.length === 0) {
                        return;
                    }
                    self.table.fields = self.fields(data[0].attributes.mappedKeys);
                    self.table.items = self.items(data);
                    self.table.itemsControls = self.itemsControls(data);
                    self.table.loading = false;

                })
                .catch(function (error) {
                    console.log(error.data);
                    self.table.loading = false;
                });
        },

        /**
         * Создает структуру таблицы на основе ответа от бэкэнда.
         * @param axiosMappedKeys
         */
        fields: function (axiosMappedKeys) {
            return [
                {
                    key: "id",
                    label: axiosMappedKeys.id,
                    width: 5,
                },
                {
                    key: "description",
                    label: axiosMappedKeys.description,
                    editable: true,
                    width: 30,
                    filter: {
                        type: "text",
                        options: {
                            placeholder: "Поиск по описанию"
                        },
                        value: null
                    }
                },
                {
                    key: "status",
                    label: axiosMappedKeys.status,
                    editable: true,
                    width: 10,
                    filter: {
                        type: "select",
                        options: this.statuses(),
                    }
                },
                {
                    key: "time_of_creation",
                    label: axiosMappedKeys.time_of_creation,
                    width: 10,
                    filter: {
                        type: "select",
                        options: [
                            "Текущий день",
                            "Текущую неделю",
                            "Текущий месяц",
                        ],
                    }
                }
                ,
                {
                    key: "period_of_execution",
                    label: axiosMappedKeys.period_of_execution,
                    editable: true,
                    width: 10,
                    filter: {
                        type: "select",
                        options: [
                            "Текущий день",
                            "Текущую неделю",
                            "Текущий месяц",
                        ],
                    }
                },
                {
                    key: "actions",
                    label: "Действие",
                    width: 8
                },
            ]
        },

        /**
         * заполняет таблицу на основе ответа от бека
         * @param axiosTasks
         * @return {*}
         */
        items: function (axiosTasks) {
            let self = this;
            return axiosTasks.map(function (task) {
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
        itemsControls(axiosTasks) {
            let self = this;
            return axiosTasks.map(function (task) {
                return self.defaultItemControl();
            });
        },

        itemEditing: function (index) {
            return this.table.itemsControls[index].editing;
        },

        itemEditable: function (fieldKey) {
            return this.table.fields.find(function (field) {
                return field.key === fieldKey && field.editable === true;
            });
        },

        itemError: function (errorKey, index) {
            return this.table.itemsControls[index].errors[errorKey];
        },

        itemInvalid: function (fieldKey, index) {
            let errors = this.table.itemsControls[index].errors;
            return errors.hasOwnProperty(fieldKey);
        },

        itemLoading: function (index) {
            return this.table.itemsControls[index].loading;
        },

        defaultItemControl: function () {
            return {
                editing: false, // редактируется ли строка  в текущий момент
                new: false, //указывает новая ли это строка
                loading: false,
                invalid: false,
                errors: {} //ошибки редактирования если они есть.
            };
        },

        /**
         * Преобразует дату из timestamp в дд.мм.гггг (чч:мм)
         * */
        convertTime: function (timestamp) {
            return moment(timestamp * 1000, 'x').format('DD.MM.YYYY (HH:mm)');
        },

        /**
         * Конвертит время обратно в timestamp
         * */
        revertTime: function (timeString) {
            return moment(timeString, 'DD.MM.YYYY (HH:mm)x').format('x') / 1000;
        },

        /**
         * Сохарняет измененную задачу.
         * todo: При отправке формы видно что время меняется на timestamp;
         * */
        saveTask: function (item, index) {
            let itemControl = this.table.itemsControls[index];
            itemControl.loading = true;
            if (itemControl.new) {
                this.saveNewTask(item, index);
                return;
            }
            let self = this;
            let itemData = item;
            itemData.period_of_execution = this.revertTime(itemData.period_of_execution);
            itemData.time_of_creation = this.revertTime(itemData.time_of_creation);
            axios({
                method: "POST",
                url: "/problems/problems/update-problem",
                data: itemData,
                headers: {"Content-Type": "application/json"}
            })
                .then(function (response) {
                    let data = response.data.data;
                    item.status = data.attributes.status;
                    item.time_of_creation = self.convertTime(data.attributes.time_of_creation);
                    item.period_of_execution = self.convertTime(data.attributes.period_of_execution);
                    itemControl.editing = false;

                    self.$set(self.table.itemsControls, index, itemControl); //добавляем реактивности.
                    self.$set(self.table.items, index, item); //добавляем реактивности.
                })
                .catch(function (error) {
                    if (error.status === 500) {
                        //произошла неизвестная ошибка

                        return;
                    }
                    let axiosError = body.response.data;
                    if (axiosError.hasOwnProperty('errors')) {
                        let errors = axiosError.errors;
                        if (errors.find(error => error.title === "author_id")) {
                            console.log('Ошибка авторизации')
                        }
                        for (let error in errors) {
                            itemControl.errors[errors[error].title] = errors[error].description
                        }
                        // item.time_of_creation = self.convertTime(data.attributes.time_of_creation);
                        // item.period_of_execution = self.convertTime(data.attributes.period_of_execution);

                        self.$set(self.table.itemsControls, index, itemControl); //добавляем реактивности.
                        self.$set(self.table.items, index, item); //добавляем реактивности.
                    }

                    //произошла неизвестная ошибка.

                });
        },

        saveNewTask: function (item, index) {
            let itemControl = this.table.itemsControls[index];
            let self = this;
            let sendItem = Object.assign({}, item);
            sendItem.author_id = 8;
            //в item нужно изменить дату в timestamp
            axios({
                method: "POST",
                url: "/problems/problems/add-problem",
                data: sendItem,
                headers: {"Content-Type": "application/json"}
            })
                .then(function (body) {
                    let data = body.data.data;
                    itemControl.editing = false;
                    itemControl.loading = false;
                    itemControl.new = false;
                    item.id = data.id;
                    item.time_of_creation = self.convertTime(data.attributes.time_of_creation);
                    item.period_of_execution = self.convertTime(data.attributes.period_of_execution);
                    item.status = data.attributes.status;
                    self.$set(self.table.itemsControls, index, itemControl); //добавляем реактивности.
                    self.$set(self.table.items, index, item); //добавляем реактивности.
                })
                .catch(function (body) {
                    let axiosError = body.response.data;
                    itemControl.invalid = true;
                    if (axiosError.hasOwnProperty('errors')) { //сработало исключение, ошибка валидна
                        let errors = axiosError.errors;
                        if (errors.find(error => error.title === "author_id")) {
                            console.log('Ошибка авторизации')
                        }
                        for (let error in errors) {
                            itemControl.errors[errors[error].title] = errors[error].description
                        }
                    } else {
                        console.log("Произошла неизвестная ошибка")
                    }
                    itemControl.loading = false;
                    itemControl.new = true;
                    self.$set(self.table.itemsControls, index, itemControl); //добавляем реактивности.
                    self.$set(self.table.items, index, item); //добавляем реактивности.
                });
        },

        /**
         * обрабатывает кнопку "добавить задачу".
         */
        addRow: function () {
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
            itemControl.new = true;
            this.table.itemsControls.push(itemControl);
            this.changeTask(itemControl);
        },

        changeTask: function (itemControl) {
            this.cancelAllChangeTask();
            itemControl.editing = true;
        },

        cancelChangeTask: function (index) {
            this.table.itemsControls[index].editing = false;
        },

        cancelAllChangeTask: function () {
            this.table.itemsControls.map(function (itemControl) {
                itemControl.editing = false;
            });

        },

        /**
         * @param item - сам элемент откуда берем ид для удаления данных.
         * @param index - номер элемента в массиве (в таблице на фронте)
         * */
        deleteTask: function (item, index) {
            let itemControl = this.table.itemsControls[index];
            if (itemControl.new) {
                this.table.itemsControls.splice(index, 1);
                this.table.items.splice(index, 1);
                return;
            }
            let self = this;
            axios({
                method: "POST",
                url: "/problems/problems/delete-problem",
                data: {id: item.id},
                headers: {"Content-Type": "application/json"}
            })
                .then(function (response) {
                    self.table.itemsControls.splice(index, 1);
                    self.table.items.splice(index, 1);

                })
                .catch(function (error) {
                    //вывести предупреждение что не удалось удалить.
                    error.data;
                });

        },

        redirectToViewPage: function (index) {
            let idItem = this.table.items[index].id;
            window.location.href = "/tasks/view/";
        },

        statuses: function () {
            return [
                "Новый",
                "В работе",
                "Завершен"
            ]
        },

        buttonSaveFilter: function () {
            this.$swal({
                title: 'Назовите фильтр',
                text: 'Фильтр появится в пункте меню "Фильтры", после сохранения',
                type: 'warning',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Сохранить',
                cancelButtonText: 'Отмена',
                showCloseButton: true,
                showLoaderOnConfirm: true
            }).then((result) => {
                if (result.value) {
                    let filterValues = [];
                    this.table.fields.forEach(function(itemField){
                        if (
                            itemField.hasOwnProperty('filter')
                            && itemField.filter.hasOwnProperty('value')
                            && itemField.filter.value !== null
                        ) {
                            filterValues[itemField.key] = itemField.filter.value;
                        }
                    });
                    this.axiosSaveFilter(result.value, filterValues);
                    this.$swal("Сохранено", 'Фильтр успешно сохранен', 'success')
                }
            });
        },

        /**
         * @param filterTitle string
         * @param filterValues Object[]
         * */
        axiosSaveFilter: function(filterTitle, filterValues) {
            //сделать проверку на пустой массив.
            console.log(filterValues);
            console.log(filterTitle);

            //После сохранения применить фильтр.
        },

        convertToTimestampCurrentDay(){
            return moment().format('x');
        },

        convertToTimestampCurrentMonth(){
            
        },

        convertToTimestampCurrentYear(){

        }
    }

});