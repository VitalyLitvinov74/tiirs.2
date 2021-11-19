<?php
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Crovex</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Projects</a></li>
                    <li class="breadcrumb-item active">New Project</li>
                </ol>
            </div>
            <h4 class="page-title">New Project</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<!-- end page title end breadcrumb -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Create Project Form</h4>
                <p class="text-muted mb-3">Basic example to create project form styles.</p>
                <div class="row">
                    <div class="col-lg-6">
                        <form>
                            <div class="form-group">
                                <label for="projectName">Project Name :</label>
                                <input type="text" class="form-control" id="projectName" aria-describedby="emailHelp" placeholder="Enter project name">
                            </div><!--end form-group-->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-6 mb-2 mb-lg-0">
                                        <label for="pro-start-date">Project Start Date</label>
                                        <input type="text" class="form-control" id="pro-start-date" placeholder="Enter start date">
                                    </div><!--end col-->
                                    <div class="col-lg-3 col-6 mb-2 mb-lg-0">
                                        <label for="pro-end-date">Project End Date</label>
                                        <input type="text" class="form-control" id="pro-end-date" placeholder="Enter end date">
                                    </div><!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <label for="pro-rate">Rate</label>
                                        <input type="text" class="form-control" id="pro-rate" placeholder="Enter rate">
                                    </div><!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <label for="pro-end-date">Price Type</label>
                                        <select class="form-control">
                                            <option>Hourly</option>
                                            <option>Daily</option>
                                            <option>Fix</option>
                                        </select>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end form-group-->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 mb-2 mb-lg-0">
                                        <label for="pro-end-date">Required</label>
                                        <select class="form-control">
                                            <option>--Select--</option>
                                            <option>UI/UX Design</option>
                                            <option>Payment System </option>
                                            <option>Android 10</option>
                                        </select>
                                    </div><!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <label for="pro-end-date">Invoice Time</label>
                                        <select class="form-control">
                                            <option>30 Day</option>
                                            <option>3 Month</option>
                                            <option>1 Year</option>
                                        </select>
                                    </div><!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <label for="pro-end-date">Priority</label>
                                        <select class="form-control">
                                            <option>-- select --</option>
                                            <option>High</option>
                                            <option>Medium</option>
                                            <option>Low</option>
                                        </select>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end form-group-->
                            <div class="form-group">
                                <label for="pro-message">Message</label>
                                <textarea class="form-control" rows="5" id="pro-message"  placeholder="writing here.."></textarea>
                            </div><!--end form-group-->

                            <button type="submit" class="btn btn-gradient-primary">Create project</button>
                            <button type="button" class="btn btn-gradient-danger">Cancel</button>
                        </form>  <!--end form-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
