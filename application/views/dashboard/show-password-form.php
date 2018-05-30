<?php $this->load->view('dashboard/header'); ?>
<div class="container">
    <!-- change password form : start -->
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <h3 class="margin-left-10">Change Password</h3>
        <div class="padding-top-15">
            <div class="panel shadow margin-bottom-40 panel-default">
                <div class="panel-body">
                    <form action="<?= site_url('user/change_password') ?>" method="post" id="change_password_form">
                        <h4>
                            <?= $user['firstname'] . " " . $user['surname']; ?>
                            <small class="pull-right"> (<?= $user['email'] ?>)</small>
                        </h4>
                        <hr>
                        <div class="form-group">
                            <input type="hidden" name="userId" value="<?= $userId ?>">
                            <label for="password">Password</label>
                            <input type="password" required="required" name="password" id="password" class="form-control" placeholder="Please provide new password">
                            <span class="text-danger font-12"><?= form_error('password'); ?></span>
                            <br>
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" required="required" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please confirm new password">
                            <span class="text-danger font-12"><?= form_error('confirm_password'); ?></span>
                        </div>
                        <input type="reset" name="reset" id="reset" value="Reset" class="pull-right btn btn-success">
                        <button type="submit" name="login" id="login" class="btn btn-primary margin-right-10 pull-left">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- change password form : End -->
</div>
<?php $this->load->view('dashboard/footer'); ?>
