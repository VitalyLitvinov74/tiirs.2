<?php
/**
 * @var View $this
 */

use yii\helpers\Url;
use yii\web\View;

?>
<h4 class="m-0">Зарегистрируйтесь!</h4>
<p class="mb-5">Создайте свой аккаунт в системе ТОиРУС</p>

<form
        @submit.prevent="sendForm"
        novalidate
        id="create-user"
        :class="{loading : requestProcessed}"
>
    <div class="form-group">
        <label class="text-label" for="name_2">Как к вам обращаться:</label>
        <div class="input-group input-group-merge">
            <input
                    id="name_2"
                    type="text"
                    required="true"
                    class="form-control form-control-prepended"
                    placeholder="Владимир Владимирович"
                    v-model="name.value"
                    :class="{ 'is-invalid' : name.invalid }"
            >
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-user"></span>
                </div>
            </div>
            <div class="invalid-feedback">{{ name.feedback }}</div>
        </div>
    </div>
    <div class="form-group">
        <label class="text-label" for="email_2">Логин:</label>
        <div class="input-group input-group-merge">
            <input
                    id="email_2"
                    type="email"
                    required="true"
                    class="form-control form-control-prepended"
                    placeholder="BigBoss"
                    v-model="login.value"
                    :class="{ 'is-invalid' : login.invalid }"
            >
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback">{{ login.feedback }}</div>
        </div>
    </div>
    <div class="form-group">
        <label class="text-label" for="password_2">Пароль:</label>
        <div class="input-group input-group-merge">
            <input
                    id="password_2"
                    type="password"
                    required="true"
                    class="form-control form-control-prepended"
                    placeholder="Введите ваш пароль"
                    v-model="password.value"
                    :class="{ 'is-invalid' : password.invalid }"
            >
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-key"></span>
                </div>
            </div>
            <div class="invalid-feedback">{{ password.feedback }}</div>
        </div>
    </div>
    <div class="form-group text-center">
        <button class="btn btn-primary mb-2" type="submit">Создать аккаунт</button>
        <br>
        <a
                class="text-body text-underline"
                href="<?= Url::toRoute(['auth/login']) ?>"
        >
            Уже есть аккаунт? Авторизуйтесь!
        </a>
    </div>
</form>
<?php

$url = Url::toRoute(['user/user/create']);
$urlToTasks = Url::toRoute(['tasks/list']);
$this->registerJs(<<<JS
    var field = function(){
        return {
            value: null,
            invalid: false,
            feedback: null,
        }
    } ;
    var vue = new Vue({
        el: "#create-user",
        data() {
            return {
                login: {},
                password: {},
                name: {},
                requestProcessed: false,
            }
        },
        mounted(){
            this.login = field();
            this.password = field();
            this.name = field();
        },
        methods: {
            sendForm: function(){
                this.requestProcessed = true;
                var self = this;
                this.cleanErrors();
                axios({
                    method: "post",
                    url: "$url",
                    data: {
                        name: self.name.value,
                        login: self.login.value,
                        password: self.password.value,
                    },
                    headers: {"Content-Type":"application/json"}
                })
                .then(body => {
                    self.requestProcessed = false;
                    let data = body.data.data[0];
                    if(data.attributes.hasOwnProperty('access_token')){
                        localStorage.access_token = data.attributes.access_token;
                        window.location.href = "$urlToTasks";
                    }else{
                        //зарегистрировались но сервер не вернул ключ доступа.
                        $('#modal-danger').modal('show')
                    }
                })
                .catch(error => {
                    self.requestProcessed = false;
                    let errors = error.response.data.errors[0];
                    for (let errorTitle in errors){
                        if(errors.hasOwnProperty(errorTitle)){
                           let errorDescription = errors[errorTitle][0];
                            if(Array.isArray(errors[errorTitle])){
                                self.handleInputErrors(errorTitle, errorDescription);
                            }else{
                                let remoteDesc = errors[errorTitle];
                                self.handleRemoteErrors(remoteDesc);
                            } 
                        }
                    }
                })
            },
            handleInputErrors: function(errorTitle, errorDescription) {
                switch (errorTitle) {
                   case 'login':
                       this.login.invalid = true;
                       this.login.feedback = errorDescription;
                   break;
                   case 'password':
                       this.password.invalid = true;
                       this.password.feedback = errorDescription;
                   break;
                   case "name": 
                       this.name.invalid = true;
                       this.name.feedback = errorDescription;
                   break;
               } 
            },
            handleRemoteErrors: function(){
                
            },
            cleanErrors: function(){
                let data = this.\$data;
                for (let field in data){
                    if(data[field].hasOwnProperty('invalid') && data[field].hasOwnProperty('feedback')){
                        data[field].invalid = false;
                        data[field].feedback = null;
                    }
                }
            }
        }
    });
JS
);
?>
