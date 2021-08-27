<form class="form-horizontal auth-form my-4" action="index.html">

    <div class="form-group">
        <label for="username">Username</label>
        <div class="input-group mb-3">
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-user"></i>
                                                </span>
            <input type="text" class="form-control" id="username" placeholder="Enter username">
        </div>
    </div><!--end form-group-->

    <div class="form-group">
        <label for="userpassword">Password</label>
        <div class="input-group mb-3">
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-lock"></i>
                                                </span>
            <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
        </div>
    </div><!--end form-group-->

    <div class="form-group row mt-4">
        <div class="col-sm-6">
            <div class="custom-control custom-switch switch-success">
                <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                <label class="custom-control-label text-muted" for="customSwitchSuccess">Remember me</label>
            </div>
        </div><!--end col-->
        <div class="col-sm-6 text-right">
            <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>
        </div><!--end col-->
    </div><!--end form-group-->

    <div class="form-group mb-0 row">
        <div class="col-12 mt-2">
            <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="button">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
        </div><!--end col-->
    </div> <!--end form-group-->
</form><