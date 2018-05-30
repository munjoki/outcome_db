<?php $this->load->view('dashboard/header');?>
<div class="container-fluid" style="overflowx:hidden">
    <!-- Page Heading End -->
    <div class="row ">
            <div class="col-sm-6 col-xs-12 ">
                <!-- Search Form Start -->
                <form class="form-inline pull-left" id="search_form" action="<?=site_url('dashboard/search')?>" method="POST">
                    <div class="input-group">
                        <input type="text" required="required" class="form-control" id="search_item" name="search_item" placeholder="Search"/>
                        <div class="input-group-btn">
                            <button type="submit" id="search_button" name="search_button" class="btn btn-success">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                    <div id="search_error" class="text-danger font-13 weight-400">
                        <?php if (isset($search_error) && strlen(trim($search_error)) > 0):?>
                            <?=$search_error?>
                        <?php endif;?>
                    </div>
                </form>
                <!-- Search Form End -->
            </div>
            <div class="col-sm-2 col-sm-offset-2 col-xs-12">
                <a href="<?=site_url("dashboard/addStudy")?>" class="btn btn-info btn-block">
                    Add New Study&nbsp;&nbsp;
                    <i class="glyphicon glyphicon-th"></i>
                </a>
            </div>
            <div class="col-sm-2 col-xs-12">
                <a href="<?=site_url("dashboard/download/all")?>" class="btn btn-primary btn-block">
                    Download &nbsp;
                    <i class="glyphicon glyphicon-download-alt"></i>
                </a>
            </div>
    </div>
    
    <div class=" margin-top-5 padding-5">
        <div class="table-responsive">
            <table id="example" class="table table-bordered  table-hover table-striped" data-page-length='25'>
                <thead>
                    <tr>
                        <th class="weight-300 font-10">
                            Agency&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        <th class="weight-300 font-10">
                            Study Title
                        </th>
                        <th class="weight-300 font-10">
                            Study Objective(s)
                        </th>
                        <th class="weight-300 font-10">
                            Country(ies) Covered&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        <th class="weight-300 font-10">
                            Start-Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        <th class="weight-300 font-10">
                            End-Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        <th class="weight-300 font-10">
                            Contact Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        <th class="weight-300 font-10">
                            Contact Email
                        </th>
                        <th class="weight-300 font-10">
                            View
                        </th>
                        <th class="weight-300 font-10">
                            Edit
                        </th>
                        <th class="weight-300 font-10">
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody  class="list_body">
                    <?php if (isset($studies) && count($studies)>
                    0 && $studies !== false): ?>
                    <?php foreach ($studies as $study): ?>
                    <tr id="<?=site_url('dashboard/view').'/'.$study['id'];?>">
                        <td class="sm-td view-page" style='cursor:pointer !important;'>
                            <div class="padding-2" style='cursor:inherit !important;'>
                                <?=$study['agency_name']?>
                            </div>
                        </td>
                        <td class="sm-td view-page" style='cursor:pointer !important;'>
                            <div class="padding-2" style='cursor:inherit !important;'>
                                <?=substr($study['title'], 0, 100)." .. ";?>
                            </div>
                        </td>
                        <td class="sm-td view-page" style='cursor:pointer !important;'>
                            <div class="padding-2" style='cursor:inherit !important;'>
                                <?=substr($study['objectives'],0,100)." .. ";?>
                            </div>
                        </td>
                        <td class="sm-td view-page" style='cursor:pointer !important;'>
                            <div class="padding-2" style='cursor:inherit !important;'>
                                <?=$study['country_name']?>
                            </div>
                        </td>
                        <td class="sm-td view-page" style='cursor:pointer !important;'>
                            <div class="padding-2" style='cursor:inherit !important;'>
                                <?=$study['start_date']?>
                            </div>
                        </td>
                        <td class="sm-td view-page" style='cursor:pointer !important;'>
                            <div class="padding-2" style='cursor:inherit !important;'>
                                <?=$study['end_date']?>
                            </div>
                        </td>
                        <td class="sm-td view-page" style='cursor:pointer !important;'>
                            <div class="padding-2" style='cursor:inherit !important;'>
                                <?=$study['contact_name']?>
                            </div>
                        </td>
                        <td class="sm-td view-page" style='cursor:pointer !important;'>
                            <div class="padding-2" style='cursor:inherit !important;'>
                                <?=$study['contact_email']?>
                            </div>
                        </td>
                        <td style="background-color:#5BC0DE!important">
                            <div>
                                <a href="<?=site_url('dashboard/view/')."/".$study['id'];?>" class="btn btn-info btn-sm-td-center  btn-block" >
                                    <i class="glyphicon glyphicon-list-alt">
                                    </i>
                                </a>
                                <divc class="clearfix">
                                </div>
                            </div>
                        </td>
                        <td style="background-color:#F0AD4E!important" >
                            <a href="<?=site_url('dashboard/edit/')."/".$study['id'];?>" class="btn btn-warning btn-sm-td-center  btn-block">
                                <i class="glyphicon glyphicon-edit">
                                </i>
                            </a>
                        </td>
                        <td style="background-color:#D9534F!important">
                            <a href="<?=site_url('dashboard/delete/')."/".$study['id'];?>" class="btn btn-danger btn-sm-td-center  btn-block delete">
                                <i class="glyphicon glyphicon-trash">
                                </i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('dashboard/footer');?>
