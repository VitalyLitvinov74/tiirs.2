<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="ltr">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


<body>
<?php $this->beginBody() ?>

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">

            <a href="#" class="logo ">

                <span>
                    <img class="logo-lg"
                         src="/auth/images/stack-logo-blue.svg"
                         style="width:30px; height:30px"
                         alt="ТОиРУс 3.0"
                    >
                </span>
<!--                <span style="-->
<!--                        font-size: 1.5rem;-->
<!--                        font-weight: 600;-->
<!---->
<!--                    ">-->
<!--                    ТОиРУс 3.0-->
<!--                </span>-->
            </a>
        </div>
        <!--end logo-->
        <!-- Navbar -->
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav float-right mb-0">

<!--                <li class="dropdown notification-list">-->
<!--                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"-->
<!--                       aria-haspopup="false" aria-expanded="false">-->
<!--                        <i class="ti-bell noti-icon"></i>-->
<!--                        <span class="badge badge-danger badge-pill noti-icon-badge">2</span>-->
<!--                    </a>-->
<!--                    <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0">-->
<!---->
<!--                        <h6 class="dropdown-item-text font-15 m-0 py-3 bg-primary text-white d-flex justify-content-between align-items-center">-->
<!--                            Notifications <span class="badge badge-light badge-pill">2</span>-->
<!--                        </h6>-->
<!--                        <div class="slimscroll notification-list">-->
                            <!-- item-->
<!--                            <a href="#" class="dropdown-item py-3">-->
<!--                                <small class="float-right text-muted pl-2">2 min ago</small>-->
<!--                                <div class="media">-->
<!--                                    <div class="avatar-md bg-primary">-->
<!--                                        <i class="la la-cart-arrow-down text-white"></i>-->
<!--                                    </div>-->
<!--                                    <div class="media-body align-self-center ml-2 text-truncate">-->
<!--                                        <h6 class="my-0 font-weight-normal text-dark">Your order is placed</h6>-->
<!--                                        <small class="text-muted mb-0">Dummy text of the printing and industry.</small>-->
<!--                                    </div> -->
<!--                                        end media-body-->
<!--                                </div>-->
                <!--end media-->
<!--                            </a>-->
                <!--end-item-->
                <!-- item-->
<!--                            <a href="#" class="dropdown-item py-3">-->
<!--                                <small class="float-right text-muted pl-2">10 min ago</small>-->
<!--                                <div class="media">-->
<!--                                    <div class="avatar-md bg-success">-->
<!--                                        <i class="la la-group text-white"></i>-->
<!--                                    </div>-->
<!--                                    <div class="media-body align-self-center ml-2 text-truncate">-->
<!--                                        <h6 class="my-0 font-weight-normal text-dark">Meeting with designers</h6>-->
<!--                                        <small class="text-muted mb-0">It is a long established fact that a reader.</small>-->
<!--                                    </div>-->
                <!--end media-body-->
<!--                                </div>-->
                <!--end media-->
<!--                            </a>-->
                <!--end-item-->
                <!-- item-->
<!--                            -->
<!--                            <a href="#" class="dropdown-item py-3">-->
<!--                                <small class="float-right text-muted pl-2">40 min ago</small>-->
<!--                                <div class="media">-->
<!--                                    <div class="avatar-md bg-pink">-->
<!--                                        <i class="la la-list-alt text-white"></i>-->
<!--                                    </div>-->
<!--                                    <div class="media-body align-self-center ml-2 text-truncate">-->
<!--                                        <h6 class="my-0 font-weight-normal text-dark">UX 3 Task complete.</h6>-->
<!--                                        <small class="text-muted mb-0">Dummy text of the printing.</small>-->
<!--                                    </div>-->
                <!--end media-body-->
<!--                                </div>-->
                <!--end media-->
<!--                            </a>-->
                <!--end-item-->
<!--                            -->
                <!-- item-->
<!--                            <a href="#" class="dropdown-item py-3">-->
<!--                                <small class="float-right text-muted pl-2">1 hr ago</small>-->
<!--                                <div class="media">-->
<!--                                    <div class="avatar-md bg-warning">-->
<!--                                        <i class="la la-truck text-white"></i>-->
<!--                                    </div>-->
<!--                                    <div class="media-body align-self-center ml-2 text-truncate">-->
<!--                                        <h6 class="my-0 font-weight-normal text-dark">Your order is placed</h6>-->
<!--                                        <small class="text-muted mb-0">It is a long established fact that a reader.</small>-->
<!--                                    </div>-->
                <!--end media-body-->
<!--                                </div>-->
                <!--end media-->
<!--                            </a>-->
                <!--end-item-->
<!--                            -->
                <!-- item-->
<!--                            <a href="#" class="dropdown-item py-3">-->
<!--                                <small class="float-right text-muted pl-2">2 hrs ago</small>-->
<!--                                <div class="media">-->
<!--                                    <div class="avatar-md bg-info">-->
<!--                                        <i class="la la-check-circle text-white"></i>-->
<!--                                    </div>-->
<!--                                    <div class="media-body align-self-center ml-2 text-truncate">-->
<!--                                        <h6 class="my-0 font-weight-normal text-dark">Payment Successfull</h6>-->
<!--                                        <small class="text-muted mb-0">Dummy text of the printing.</small>-->
<!--                                    </div>-->
                <!--end media-body-->
<!--                                </div>-->
                <!--end media-->
<!--                            </a>-->
                <!--end-item-->
<!--                        </div>-->
                       <!-- All-->
<!--                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary">-->
<!--                            View all <i class="fi-arrow-right"></i>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </li>-->

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img src="/images/users/user-1.png" alt="profile-user" class="rounded-circle" />
                        <span class="ml-1 nav-user-name hidden-sm">Amelia <i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> Профиль</a>
<!--                        <a class="dropdown-item" href="#"><i class="ti-wallet text-muted mr-2"></i> My Wallet</a>-->
<!--                        <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i> Settings</a>-->
<!--                        <a class="dropdown-item" href="#"><i class="ti-lock text-muted mr-2"></i> Lock screen</a>-->
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="<?=\yii\helpers\Url::toRoute(['auth/login'])?>"><i class="ti-power-off text-muted mr-2"></i> Выход</a>
                    </div>
                </li>
            </ul><!--end topbar-nav-->

            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile waves-effect waves-light">
                        <i class="ti-menu nav-icon"></i>
                    </button>
                </li>
                <li class="hide-phone app-search">
                    <form role="search" class="">
                        <input type="text" id="AllCompo" placeholder="Поиск по системе..." class="form-control">
                        <a href=""><i class="fas fa-search"></i></a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->


    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <ul class="metismenu left-sidenav-menu">
            <li>
                <a href="<?=Url::toRoute(['tasks/list'])?>"><i class="ti-bar-chart"></i><span>Главная страница</span></a>
            </li>

            <li class="mm-active active">
                <a  href="<?=Url::toRoute(['tasks/list'])?>"><i class="ti-layers-alt"></i><span>Задачи</span>
<!--                    <span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>-->
                </a>
<!--                <ul class="nav-second-level" aria-expanded="false">-->
<!--                    <li class="nav-item"><a class="nav-link" href="../pages/pages-profile.html"><i class="ti-control-record"></i>Profile</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../pages/pages-timeline.html"><i class="ti-control-record"></i>Timeline</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../pages/pages-treeview.html"><i class="ti-control-record"></i>Treeview</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../pages/pages-starter.html"><i class="ti-control-record"></i>Starter Page</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../pages/pages-pricing.html"><i class="ti-control-record"></i>Pricing</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../pages/pages-gallery.html"><i class="ti-control-record"></i>Gallery</a></li>-->
<!--                </ul>-->
            </li>

<!--            <li>-->
<!--                <a href="javascript: void(0);"><i class="ti-lock"></i><span>Authentication</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>-->
<!--                <ul class="nav-second-level" aria-expanded="false">-->
<!--                    <li class="nav-item"><a class="nav-link" href="../authentication/auth-login.html"><i class="ti-control-record"></i>Log in</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../authentication/auth-register.html"><i class="ti-control-record"></i>Register</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../authentication/auth-recover-pw.html"><i class="ti-control-record"></i>Recover Password</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../authentication/auth-lock-screen.html"><i class="ti-control-record"></i>Lock Screen</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../authentication/auth-404.html"><i class="ti-control-record"></i>Error 404</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" href="../authentication/auth-500.html"><i class="ti-control-record"></i>Error 500</a></li>-->
<!--                </ul>-->
<!--            </li>-->
        </ul>
    </div>
    <!-- end left-sidenav-->

    <div class="page-wrapper">
        <!-- Page Content-->
        <div class="page-content">

            <div class="container-fluid">

                <?=$content?>

            </div><!-- container -->

            <footer class="footer text-center text-sm-left">
                &copy; 2021 ООО "Челябинский Иновационный Центр" <!--<span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>-->
            </footer><!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
