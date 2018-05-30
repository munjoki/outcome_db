<?php $this->load->view('auth/header'); ?>
<div class="container">
    <!-- login form : start -->
     	<div class="col-xs-12 padding-top-5 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="margin-top-35 row padding-top-50">
                <div class="panel shadow margin-top-25 margin-bottom-40 panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                        <span class="pull-left  margin-top-10">Reset Password</span>
						<a class="pull-right btn btn-sm  btn-info" href="<?=site_url('authentication')?>">Home Page</a>
                        </h3>
                         <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <form action="<?=site_url('authentication/sendPasswordToken')?>" method="POST" role="form">
                        <?php if(isset($message)): ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <div class="text-center"><?=$message?></div>
                            </div>
                        <?php endif;?>
                            <div class="form-group">
                                <label for="email" class="font-12 weight-400">Email Address</label>
                                <input type="email" required="required" name="email" id="email" class="form-control input-sm" placeholder="Please provide your registered email address">
                                <span class="text-danger font-12"><?=form_error('email');?></span>
                            </div>
                            <button type="submit" name="login" id="login" class="btn btn-sm btn-primary">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- login form : End -->
</div>
<?php $this->load->view('auth/footer'); ?>
