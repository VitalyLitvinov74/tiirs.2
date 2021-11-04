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
                   class="form-control form-control-prepended" placeholder="Имя пользователя">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="text-label" for="password_2">Пароль:</label>
        <div class="input-group input-group-merge">
            <input id="password_2" type="password" v-model="store.password" required=""
                   class="form-control form-control-prepended" placeholder="Введите ваш пароль">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group mb-5">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" checked="" id="remember">
            <label class="custom-control-label" for="remember">Запомнить меня</label>
        </div>
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
                store: store
            }
        },
        mounted(){
            console.log('mounted')
        },
        methods: {
            sendForm: function(){
                axios({
                    method: "post",
                    url: '/user/user/login',
                    data: this.store,
                    headers: { "Content-Type": "application/json" },
                })
                .then(function (response){
                    
                })
                .catch(function (body){
                    // body.response.clientDataJSON
                    for(let error in body.response.data.errors){
                        if(error.title == 'user'){
                            window.location = '/auth/create-first-user';
                        }
                    }
                    console.log(body.response.data);
                })
                
            }
        }
    });
JS
);
?>


