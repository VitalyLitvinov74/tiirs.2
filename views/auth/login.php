<?php
/**
 * @var View $this
 */
?>
<h4 class="m-0">С возвращением!</h4>
<p class="mb-5">Авторизуйтесь в вашем аккаунте </p>

<form novalidate @submit.prevent="sendForm">
    <div class="form-group">
        <label class="text-label" for="email_2">Логин:</label>
        <div class="input-group input-group-merge">
            <input id="email_2" type="email" required="" v-model="store.login"
                   class="form-control form-control-prepended"
                   :class="{ 'is-invalid' : login.invalid}"
                   placeholder="Имя пользователя">
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
            <input id="password_2" type="password" v-model="store.password" required=""
                   class="form-control form-control-prepended"
                   :class="{ 'is-invalid' : password.invalid }"
                   placeholder="Введите ваш пароль">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
            <div class="invalid-feedback">{{ password.feedback }}</div>
        </div>
    </div>
    <div class="form-group mb-5">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" checked="" id="remember">
            <label class="custom-control-label" for="remember">Запомнить меня</label>
        </div>
    </div>
    <div class="form-group mb-5">
        <div v-if="remote.invalid" class="alert alert-danger" role="alert">{{ remote.feedback }}</div>
    </div>

    <div class="form-group text-center">
        <button class="btn btn-primary mb-5" type="submit">Войти</button>
        <br>
        <a href="">Забыли пароль?</a> <br>
    </div>
</form>
<?php
$this->registerJs(<<<JS
    var store = {
                    login: null,
                    password: null
                };
    var vue = new Vue({
        "el": "#auth",
        data(){
            return {
                store: store,
                login: {
                    invalid: false,
                    feedback: null,
                },
                password:{
                    invalid: false,
                    feedback: null  
                },
                remote: {
                    invalid: false,
                    feedback: null
                }
            }
        },
        methods: {
            sendForm: function(){
                this.cleanErrors();
                var self = this;
                axios({
                    method: "post",
                    url: '/user/user/login',
                    data: this.store,
                    headers: { "Content-Type": "application/json" },
                })
                .then(function (response){
                    
                })
                .catch(function (body){
                    let errors = body.response.data.errors[0];
                    for(let errorTitle in errors){
                        if(errors.hasOwnProperty(errorTitle)){
                            let errorDescription = errors[errorTitle][0];
                            if(Array.isArray(errors[errorTitle])){
                                self.handleInputErrors(errorTitle, errorDescription);
                            }else{
                                let remoteDesc = errors[errorTitle];
                                self.handleRemoteError(remoteDesc);
                            }
                        }
                    }
                })
                
            },
            handleInputErrors: function(errorTitle, errorDescription){
               switch (errorTitle) {
                   case 'login':
                       this.login.invalid = true;
                       this.login.feedback = errorDescription;
                   break;
                   case 'password':
                       this.password.invalid = true;
                       this.password.feedback = errorDescription;
                   break;
               } 
            },
            
            handleRemoteError: function(description){
                this.remote.invalid = true;
                this.password.invalid = true;
                this.login.invalid = true;
                this.remote.feedback = description;
            },
            
            cleanErrors: function() {
                this.password.invalid = false;
                this.login.invalid = false;
            }
        }
    });
JS
);
?>


