<?php
/**
 * @var View $this
 */

use yii\web\View;

\app\assets\AuthAsset::register($this);
\app\assets\VueAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <meta name="robots" content="noindex">
    <?php $this->head() ?>
</head>

<body class="layout-login">
<?=$this->beginBody()?>
<div class="layout-login__overlay"></div>
<div class="layout-login__form bg-white" id="auth" data-simplebar>
    <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
        <a href="index.html" class="navbar-brand" style="min-width: 0">
            <img class="navbar-brand-icon" src="images/stack-logo-blue.svg" width="25" alt="ТОиРУс 3.0">
<!--            <span>ТОиРУс 3.0</span>-->
        </a>
    </div>

    <h4 class="m-0">С возвращением!</h4>
    <p class="mb-5">Авторизуйтесь в вашем аккаунте </p>

    <form novalidate @submit.prevent="sendForm">
        <div class="form-group">
            <label class="text-label" for="email_2">Логин:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="email" required="" v-model="store.login" class="form-control form-control-prepended" placeholder="Имя пользователя">
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
                <input id="password_2" type="password" v-model="store.password" required="" class="form-control form-control-prepended" placeholder="Введите ваш пароль">
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
            <button class="btn btn-primary mb-5" type="submit">Войти</button><br>
            <a href="">Забыли пароль?</a> <br>
        </div>
    </form>
</div>
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
                    body: this.store
                })
            }
        }
    });
JS
);
?>
<?php $this->endBody()?>
</body>

</html>
<?php $this->endPage() ?>


