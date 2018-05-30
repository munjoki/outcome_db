<?php $this->load->view('auth/header'); ?>
<div class="container margin-top-35">
    <div class="col-xs-12 margin-top-35 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-xs-12">
        <div class="margin-top-30 row ">
            <h4 class="margin-top-35 text-center weight-300">
                Your account has been successfully activated.
            </h4>
            <div class="margin-top-40 help-text text-center">
                <?php if(isset($message)): ?>
                    <?=$message?>
                <?php endif;?>
                <br>
                <a class="btn btn-link margin-top-40" href="<?=site_url('authentication');?>">Go To Login Page</a>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('auth/footer'); ?>
