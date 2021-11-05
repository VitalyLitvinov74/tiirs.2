<?php

use app\assets\AuthAsset;

AuthAsset::register($this);
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
<?= $this->beginBody() ?>
<div class="layout-login__overlay"></div>
<div class="layout-login__form bg-white" id="auth" data-simplebar>
    <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
        <a href="index.html" class="navbar-brand" style="min-width: 0">
            <img class="navbar-brand-icon" src="images/stack-logo-blue.svg" width="25" alt="ТОиРУс 3.0">
            <!--            <span>ТОиРУс 3.0</span>-->
        </a>
    </div>
    <?= $content ?>
</div>

<?php
//    echo $this->render('modals/alert-modal-success.php');
    echo $this->render('modals/alert-modal-danger.php');
    $this->endBody()
?>
</body>
</html>
<?php $this->endPage() ?>
