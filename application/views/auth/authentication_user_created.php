<?php $this->load->view('auth/header'); ?>
<div class="container margin-top-35">
    <div class="col-xs-12 margin-top-35 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-xs-12">
        <div class="margin-top-30 row ">
            <h4 class="margin-top-35 text-center weight-300">
                Your account has been successfully created.
            </h4>
            <div class="margin-top-40 help-text text-center">
                We have sent you an activation email to your registered email address. Please follow the instructions in the email to activate your account.<br>
                <a class="btn btn-info margin-top-40" href="<?=site_url('authentication');?>">Login</a>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('auth/footer'); ?>
