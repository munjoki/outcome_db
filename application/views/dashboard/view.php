<?php $this->load->view('dashboard/header');?>
<div class="container">
 <!-- Page Heading End-->
    <div class="row margin-bottom-30">
        <div class="container">
          
        </div>
    </div>
    <div class="row margin-top-30">
        <div class="container row">
            <div class="col-sm-12 col-md-offset-1 col-md-10">
                <div class="row">
                    <div class="col-sm-2 col-xs-12">
                        <a href="<?=site_url('dashboard');?>" class=" btn-block btn btn-success">Home <i class="glyphicon glyphicon-home"></i></a>
                    </div>
                    <div class="col-sm-2 col-xs-12">
                        <a href="<?=site_url('dashboard/edit/')."/".$study['id'];?>" class="btn btn-block btn-warning">Edit&nbsp;&nbsp;<i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                    <div class="col-sm-2 col-xs-12">
                        <a href="<?=site_url('dashboard/delete/')."/".$study['id'];?>" class="delete btn-block btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></a>
                    </div>    
                    <div class="col-sm-3 col-sm-offset-3 col-xs-12">
                        <a href="<?=site_url("dashboard/addStudy")?>" class="btn btn-info btn-block">Add New Study <i class="glyphicon glyphicon-th"></i></a>
                    </div>
                    <br><br><br>
                </div>
                <table class="table table-striped table-bordered table-hover shadow">
                    <thead>
                        <tr>
                            <th class="weight-300 font-12">Study Field</th>
                            <th class="weight-300 font-12">Description</th>
                        </tr>
                    </thead>
                    <tbody  class="list_body">
                        <?php if (isset($study) && count($study)> 0 && $study !== false): ?>
                            <tr> 
                                <td><div class="sm-td">Agency name</div></td>
                                <td><div class="sm-td"><?=$study['agency_name']?></div></td>
                            </tr>
							<tr> 
                                <td><div class="sm-td">Study title</div></td>
                                <td><div class="sm-td"><?=$study['title']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Study objectives</div></td>
                                <td><div class="sm-td"><?=$study['objectives']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Study status</div></td>
                                <td><div class="sm-td"><?=$study['study_status']?></div></td>
                            </tr>
                            <!-- <tr> 
                                <td><div class="sm-td">Other Status</div></td>
                                <td><div class="sm-td"><?=$study['other_status']?></div></td>
                            </tr> -->
                            <tr> 
                                <td><div class="sm-td">Country(ies)</div></td>
                                <td><div class="sm-td"><?=$study['country_name']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Other country(ies)</div></td>
                                <td><div class="sm-td"><?=$study['other_country']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Sub-national location</div></td>
                                <td><div class="sm-td"><?=$study['sub_location']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Thematic area(s)</div></td>
                                <td><div class="sm-td"><?=$study['sector']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Other thematic area(s)</div></td>
                                <td><div class="sm-td"><?=$study['other_sector']?></div></td>
                            </tr>
                            <!--<tr> 
                                <td><div class="sm-td">Themes</div></td>
                                <td><div class="sm-td"><?=$study['theme']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Other Themes</div></td>
                                <td><div class="sm-td"><?=$study['other_theme']?></div></td>
                            </tr>-->
                            
                                                    
                            <tr> 
                                <td><div class="sm-td">Collaboration type</div></td>
                                <td><div class="sm-td"><?=$study['collaboration_type']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">AKDN agency(ies) collaboration</div></td>
                                <td><div class="sm-td"><?=$study['collaborators']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">External agency(ies) collaboration</div></td>
                                <td><div class="sm-td"><?=$study['other_collaborators']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Budget currency</div></td>
                                <td><div class="sm-td"><?=$study['currency_code']?></div></td>
                            </tr>
							<tr> 
                                <td><div class="sm-td">Total budget for the study</div></td>
                                <td><div class="sm-td"><?=$study['amount']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Year 2016 budget</div></td>
                                <td><div class="sm-td"><?=$study['amount_2016']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Funding source(s)</div></td>
                                <td><div class="sm-td"><?=$study['fund_source']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Other funding source(s)</div></td>
                                <td><div class="sm-td"><?=$study['other_fund']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Study start date</div></td>
                                <td><div class="sm-td"><?=$study['start_date']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Study end date</div></td>
                                <td><div class="sm-td"><?=$study['end_date']?></div></td>
                            </tr>
                            
                            <tr> 
                                <td><div class="sm-td">Human resources</div></td>
                                <td><div class="sm-td"><?=$study['human_resource']?></div></td>
                            </tr>
							<tr> 
                                <td><div class="sm-td">Contact name</div></td>
                                <td><div class="sm-td"><?=$study['contact_name']?></div></td>
                            </tr>
                            <tr> 
                                <td><div class="sm-td">Contact email</div></td>
                                <td><div class="sm-td"><?=$study['contact_email']?></div></td>
                            </tr>
                            <!--<tr> 
                                <td><div class="sm-td">Other Human Resources</div></td>
                                <td><div class="sm-td"><?php //echo $study['other_hr']?></div></td>
                            </tr>-->
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('dashboard/footer');?>