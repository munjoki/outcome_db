<?php $this->load->view('auth/header'); ?>
<div class="container">
    <!-- login form : start -->
     	<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="margin-top-40 padding-top-25">
                <div class="panel shadow margin-bottom-40 panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                        <span class="pull-left  margin-top-10">Login</span>
						<a class="pull-right btn btn-info" href="<?=site_url('authentication/register')?>">Sign up</a>
                        </h3>
                         <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <form action="<?=site_url('authentication')?>" method="POST" role="form">
                        <?php if(isset($message)): ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <div class="text-center"><?=$message?></div>
                            </div>
                        <?php endif;?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" required="required" name="email" id="email" class="form-control" placeholder="Please provide your email address">
                                <span class="text-danger font-12"><?=form_error('email');?></span>
                                <br>
                                <label for="password">Password</label>
                                <input type="password"  required="required" name="password" id="password" class="form-control" placeholder="Please provide your password">
                                <span class="text-danger font-12"><?=form_error('password');?></span>
                            </div>
                            <input type="reset" name="reset" id="reset" value="Reset" class="pull-right btn btn-success">
                            <button type="submit" name="login" id="login" class="btn btn-primary margin-right-10 pull-right">Login</button>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <a href="<?=site_url('authentication/reset_password')?>" class="pull-right">Forgot Password?</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    <!-- login form : End -->
</div>
<?php $this->load->view('auth/footer'); ?>
