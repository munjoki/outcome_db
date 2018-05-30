<?php $this->load->view('auth/header');?>
<div class="container">
    <!-- register form : start -->
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-xs-12">
        <div class="">
            <div class="panel shadow  panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="pull-left  margin-top-10">
                            Register
                        </span>
                        <a class="pull-right btn btn-info" href="<?=site_url('authentication')?>">
                            Login
                        </a>
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <form  class="form-horizontal" action="<?=site_url('authentication/register')?>" method="POST" role="form">
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">
                                Email address
                            </label>
                            <div class="col-sm-8">
	                            <input type="email" class="form-control" value="<?php echo set_value('email'); ?>" id="email" name="email" placeholder="Please provide your email address" required="required"/>
								<span class="text-danger" ><?php echo form_error('email'); ?></span>
                            </div>
                        </div>
                        <?php if(isset($is_admin)):?>
                            <input type="hidden" name="is_admin" value="<?=$is_admin;?>">
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="surname"  class="col-sm-4 control-label">
                                Surname
                            </label>
                            <div class="col-sm-8">
	                            <input type="text" class="form-control" id="surname" value="<?php echo set_value('surname'); ?>" name="surname" placeholder="Please provide your surname" required="required"/>
	                            <span class="text-danger" ><?php echo form_error('surname'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="other_names"  class="col-sm-4 control-label">
                                First Name
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="other_names" value="<?php echo set_value('other_names'); ?>" name="other_names" placeholder="Please provide your first name" required="required"/>
                                <span class="text-danger" ><?php echo form_error('other_names'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country"  class="col-sm-4 control-label">
                                Country
                            </label>
                            <div class="col-sm-8">
	                            <select name="country" id="country" class="selectpicker form-control" required="required">
	                            	<option value="">-- Select Country --</option>
	                            	<?php if (isset($countries) && $countries != false): ?>
										<?php foreach ($countries as $country):?>
											<option value="<?=$country['id']?>" <?=set_select('country', $country['id']); ?>>
												<?=$country['country_name']?>
											</option>
										<?php endforeach;?>
	                            	<?php endif; ?>
	                            </select>
	                            <span class="text-danger" ><?php echo form_error('country'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agency"  class="col-sm-4 control-label">
                                Agency
                            </label>
                            <div class="col-sm-8">
	                            <select name="agency" id="agency" class="form-control selectpicker" required="required">
	                            	<option value="">-- Select Agency --</option>
	                            	<?php if (isset($agencies) && $agencies != false): ?>
										<?php foreach ($agencies as $agency):?>
											<option value="<?=$agency['id']?>" <?=set_select('agency', $agency['id']);?>>
												<?=$agency['agency_name']?>
											</option>
										<?php endforeach;?>
	                            	<?php endif; ?>
	                            </select>
	                            <span class="text-danger" ><?php echo form_error('agency'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label">
                                Password
                            </label>
                            <div class="col-sm-8">
	                            <input type="password" class="form-control" id="password" name="password" placeholder="Please provide your password" required="required"/>
	                            <span class="text-danger" ><?php echo form_error('password'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="col-sm-4 control-label">
                                Password Confirmation
                            </label>
                            <div class="col-sm-8">
	                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm the password provided above" required="required"/>
	                            <span class="text-danger" ><?php echo form_error('confirm_password'); ?></span>
                            </div>
                        </div>
                        <input type="reset" name="reset" id="reset" value="Reset" class="pull-right btn btn-success">
                        <input type="submit" value="Register" name="register" class="btn pull-right margin-right-10 btn-primary">
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="<?=site_url('authentication/reset_password')?>" class="pull-right">
                        Forgot Password?
                    </a>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- register form : End -->
</div>
<?php $this->load->view('auth/footer');?>
