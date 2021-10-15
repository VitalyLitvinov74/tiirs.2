<div class="container" id="app">
    <transition>
        <router-view></router-view>
    </transition>
</div>
<?php
$this->view->registerJs('
        new window.Vue({
            el: "#app",
        })', $this->view::POS_END);
?>