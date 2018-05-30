<?php $this->load->view('dashboard/header');?>
<div class="container ">
    <div class="row margin-bottom-20">
        <form  id="addStudyForm" method="POST" action="<?=site_url('dashboard/update');?>">
            <fieldset class="bg-white shadow">
                <div class="h2 text-center bg-red text-grey no-margin padding-10">MER List of Studies 2016</div>
                <div class="h3 text-left bg-white padding-left-20  padding-bottom-10">Study Details</div>

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="agency" class="weight-400 font-13">Agency</label>
                            <div class="font-13 text-primary">Your Agency Name:</div>
                            <input type="text" disabled class="form-control" value="<?=$study['agency_name'];?>">
                            <input type='hidden' name="study_identification" value="<?=$study['id']?>"/>
                        </div>
                        <div class="col-sm-6">
                            <label for="title" class="weight-400 font-13">Study Title (*)</label>
                            <div class="font-13 text-primary">Please provide the title of the study:</div>
                            <textarea required="required" rows="5" id="title" name="title" class="form-control" placeholder="Study Title"><?=$study['title'];?></textarea>
                        </div>
                    </div>
                    <hr>
                </div>


                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <label for="country" class="weight-400 font-13">Country (*)</label>
                            <div class="font-13 text-primary">Please provide the country(ies) where this study is being conducted:</div>
                            <select  multiple required="required" name="country[]" id="country" class="selectpicker form-control">
                                <?php if (isset($countries) && $countries != false): ?>
                                    <?php foreach ($countries as $country):?>
                                    <option value="<?=$country['id']?>" <?=(in_array($country['id'],$study['country_id'][1]))?'selected':''?> ><?=$country['country_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>

                            <label for="other_country" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_country']) && !empty($study['other_country']))?'visible':'hidden1' ?>">Other country(ies)</label>
                            <div class="font-13  text-primary <?=(isset($study['other_country']) && !empty($study['other_country']))?'visible':'hidden1' ?>">Please specify the other country(ies)  :</div>
                            <textarea name="other_country" required="required" id="other_country" class="form-control <?=(isset($study['other_country']) && !empty($study['other_country']))?'visible':'hidden1' ?>"  placeholder="Other country(ies)"><?=$study['other_country']?></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label for="sub_location" class="weight-400 font-13">Sub-national Location</label>
                            <div class="font-13 text-primary">Provide the sub-national location(s) within the country(ies) where the study will be based:</div>
                            <textarea rows="5" id="sub_location" name="sub_location" class="form-control" placeholder="Sub-national Location"><?=$study['sub_location'];?></textarea>
                        </div>
                    </div>
                    <hr>
                </div>


                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                    	<div class="col-sm-6">
	                        
	                    </div>
	                    <div class="col-sm-6"></div>
                    </div>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                    	<div class="col-sm-6">
                    		<label for="sector" class="weight-400 font-13">Sector (*)</label>
		                    <div class="font-13 text-primary">Please provide the sector(s) which the study covers:</div>
	                        <select  multiple required="required" name="sector[]" id="sector" class="selectpicker form-control">
	                            <?php if (isset($sectors) && $sectors != false): ?>
		                            <?php foreach ($sectors as $sector):?>
		                            	<option value="<?=$sector['id']?>" <?=(in_array($sector['id'],$study['sector_ids']))?'selected':''?>><?=$sector['sector_name']?></option>
		                            <?php endforeach;?>
	                            <?php endif?>
	                        </select>

                            <label for="other_sector" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_sector']) && !empty($study['other_sector']))?'visible':'hidden1' ?>">Other Sectors</label>
                            <div class="font-13 margin-top-4 margin-top-4 text-primary <?=(isset($study['other_sector']) && !empty($study['other_sector']))?'visible':'hidden1' ?>">
                                Please specify the other sector(s) which the study covers:
                            </div>
                            <textarea name="other_sector" required="required" id="other_sector" class="form-control <?=(isset($study['other_sector']) && !empty($study['other_sector']))?'visible':'hidden1' ?>"  placeholder="Other Sectors"><?=$study['other_sector']?></textarea>

	                    </div>
	                    <div class="col-sm-6">
		                    <label for="theme" class="weight-400 font-13">Themes (*)</label>
                            <div class="font-13 text-primary">Please provide the thematic area(s)  which the study covers:</div>
                            <select multiple required="required" name="theme[]" id="theme" class="form-control selectpicker"></select>

                            <label for="other_theme" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_theme']) && !empty($study['other_theme']))?'visible':'hidden1' ?>">Other Themes</label>
                            <div class="font-13 margin-top-4 text-primary <?=(isset($study['other_theme']) && !empty($study['other_theme']))?'visible':'hidden1' ?>">
                                Please specify the other sector(s) which the study covers:
                            </div>
                            <textarea name="other_theme" id="other_theme" class="form-control <?=(isset($study['other_theme']) && !empty($study['other_theme']))?'visible':'hidden1' ?>"  placeholder="Other Themes"><?=$study['other_theme']?></textarea>
	                    </div>
                    </div>
                    <hr>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
                	<div class="row">
                		<div class="col-sm-6">
                			<label for="objectives" class="weight-400 font-13">Study Objectives (*)</label>
		                    <div class="font-13 text-primary">Please provide the objective(s) of the study:</div>
		                    <textarea  required="required" rows="5" id="objectives" name="objectives" class="form-control"><?=$study['objectives']?></textarea>
                		</div>
                		<div class="col-sm-6">
                            <label for="study_status" class="weight-400 font-13">Study Status (*)</label>
                            <div class="font-13 text-primary">Provide the study status:</div>
                            <select required="required" name="study_status" id="study_status" class="form-control selectpicker" title="Nothing Selected">
                                <?php if (isset($statuses) && $statuses != false): ?>
                                    <?php foreach ($statuses as $status):?>
                                        <option value="<?=$status['id']?>"  <?=($status['id'] == $study['study_id'])?'selected':''?> ><?=$status['status_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            
                            <label for="other_status" class="hide weight-400 margin-top-15 font-13">Other Status (*)</label>
                            <div class="font-13 hide text-primary">Other Status:</div>
                            <input type="text" name="other_status" value="<?=$study['other_status'];?>" class="form-control hide" id="other_status" placeholder="Other Status"/>
                		</div>
                	</div>
                    <hr>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
                	<div class="row">
                		<div class="col-sm-6">
                			<label for="tools[]" class="weight-400 font-13">Method And Tools (*)</label>
                			<div class="font-13 text-primary">Please provide the main methods and tools to be used in the study:</div>
	                       	<select multiple required="required" name="tools[]" id="tools" class="form-control selectpicker">
	                            <?php if (isset($methods) && $methods != false): ?>
		                            <?php foreach ($methods as $method):?>
		                            	<option value="<?=$method['id']?>" <?=(in_array($method['id'],$study['tools_ids']))?'selected':''?>><?=$method['method_name']?></option>
		                            <?php endforeach;?>
	                            <?php endif;?>
	                        </select>

                            <label for="other_tools" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_tools']) && !empty($study['other_tools']))?'visible':'hidden1'?>">Other Methods and Tools</label>
                            <div class="font-13 margin-top-4 text-primary <?=(isset($study['other_tools']) && !empty($study['other_tools']))?'visible':'hidden1'?>">Please specify other methods and tools to be used in the study:</div>
                            <textarea name="other_tools" id="other_tools" placeholder="Other Methods and Tools" class="form-control <?=(isset($study['other_tools']) && !empty($study['other_tools']))?'visible':'hidden1'?>"><?=$study['other_tools']?></textarea>
                		</div>
                		<div class="col-sm-6">
                			<label for="collaboration_radio" class="weight-400 font-13">AKDN Collabration(*)</label>
                            <div class="font-13 text-primary">Is the study conducted in collaboration with other AKDN agency(ies)?</div>
                            <div class="checkbox">
                                <label>
                                    <?php if(isset($study['collaborators_ids'][1]) && count($study['collaborators_ids'][1]) > 0) :?>
                                        <input type="checkbox" name="collaboration_radio" checked="checked" id="collaboration_radio">
                                    <?php else : ?>
                                        <input type="checkbox" name="collaboration_radio" id="collaboration_radio">
                                    <?php endif;?>
                                    Other Agencies Collaborating?
                                </label>
                            </div>
                                
                            <label for="collaborators" class="margin-top-30 weight-400 font-13">Other Collaborating Agencies</label>
                            <div class="font-13 text-primary ">Please select all the AKDN agencies you are collaborating with in this study:</div>
                            <select multiple name="collaborators[]" id="collaborators" class="selectpicker form-control ">
                                <?php if (isset($agencies) && $agencies != false): ?>
                                    <?php foreach ($agencies as $agency):?>
                                        <option value="<?=$agency['id']?>" <?=(isset($study['collaborators_ids'][1]) && in_array($agency['id'],$study['collaborators_ids'][1]))?'selected':''?> <?=set_select('collaborators', $agency['id'])?>><?=$agency['agency_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>

                		</div>
                	</div>
                </div>
            </fieldset>


            <fieldset class="bg-white shadow margin-top-20">
                <div class="h3 text-left bg-white padding-bottom-10 margin-left-30">Funding and Human Resources</div>
                <div class="form-group padding-left-20 padding-right-20">
                	<div class="row">
                		
                		<div class="col-sm-6">
                			<label for="budget" class="weight-400 font-13">Currency (*)</label>
                			<div class="font-13 text-primary">Provide the Currency code:</div>
                			<select  required="required" name="budget" id="budget" class="form-control selectpicker" title="Nothing selected">
	                            <?php if (isset($currencies) && $currencies != false): ?>
		                            <?php foreach ($currencies as $currency):?>
		                            	<option value="<?=$currency['id']?>" <?=($currency['id'] == $study['currency_id'])?'selected':''?> ><?=$currency['currency_name']?></option>
		                            <?php endforeach;?>
	                            <?php endif?>
	                        </select>

                            <label for="other_currency" class="weight-400 margin-top-30 font-13 <?=(isset($study['currency_id']) && ($study['currency_id'] == '6'))?'visible':'hidden1' ?>">Other Currency</label>
                            <div class="font-13 margin-top-4 text-primary <?=(isset($study['currency_id']) && ($study['currency_id'] == '6'))?'visible':'hidden1' ?>">Please specify the other currency:</div>
                            <input type="text" value="<?=(isset($study['currency_id']) && ($study['currency_id'] == '6'))?$study['currency_code']:'' ?>" id="other_currency" name="other_currency" placeholder="Other Currecy" class="form-control <?=(isset($study['currency_id']) && ($study['currency_id'] == '6'))?'visible':'hidden1' ?>"/>
                		</div>
                		
                		<div class="col-sm-6">
                			<label for="amount" class="weight-400 font-13">Total Budget (*)</label>
                			<div class="font-13 text-primary">Please provide the total budget amount for the study:</div>
                			<input type="text" name="amount" value="<?=$study['amount'];?>" class="form-control" id="amount" placeholder="e.g. 10000"/>
                		</div>
                	</div>
                    <hr>
                </div>


                <div class="form-group padding-left-20 padding-right-20">
					<div class="row">
						<div class="col-sm-6">
							<label for="fund_source" class="weight-400 font-13">Funding Source (*)</label>
							<div class="font-13 text-primary">Please provide the source(s) of funding for the study:</div>
                			<select multiple required="required" name="fund_source[]" id="fund_source" class="form-control selectpicker">
	                            <option value="1" <?=(in_array('1', $study['fund_source_id']))?'selected':''?>>Internal</option>
	                            <option value="2" <?=(in_array('2', $study['fund_source_id']))?'selected':''?>>External</option>
	                        </select>
                                
                            <label for="other_fund" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_fund']) && !empty($study['other_fund']))?'visible':'hidden1' ?>">Other Funding Sources</label>
                            <div class="font-13 margin-top-4 text-primary <?=(isset($study['other_fund']) && !empty($study['other_fund']))?'visible':'hidden1' ?>">Please specify the external funding source/name:</div>
                            <textarea name="other_fund" class="form-control <?=(isset($study['other_fund']) && !empty($study['other_fund']))?'visible':'hidden1' ?>" id="other_fund" placeholder="Other External Funders"><?=$study['other_fund'];?></textarea>

						</div>
						<div class="col-sm-6">
							<label for="human_resource[]" class="weight-400 font-13">Human Resource (*)</label>
                            <div class="font-13 text-primary">Please select the human resources involved in this study:</div>
                            <select multiple required="required" name="human_resource[]" id="human_resource" class="form-control selectpicker">
                                <option value="1" <?=(in_array('1', $study['human_resource_id']))?'selected':''?>>Internal</option>
                                <option value="2" <?=(in_array('2', $study['human_resource_id']))?'selected':''?>>External</option>
                            </select>

                            <label for="other_hr" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_hr']) && !empty($study['other_hr']))?'visible':'hidden1' ?>">Other Human Reources</label>
                            <div class="font-13 margin-top-4 text-primary <?=(isset($study['other_hr']) && !empty($study['other_hr']))?'visible':'hidden1' ?>">Please specify the external human resources:</div>
                            <textarea name="other_hr" class="form-control <?=(isset($study['other_hr']) && !empty($study['other_hr']))?'visible':'hidden1' ?>" id="other_hr" placeholder="Other Funders"><?=$study['other_hr'];?></textarea>
						</div>
					</div>
                    <hr>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
	                <div class="row">
	                	<div class="col-sm-6">
	                		<label for="start_date" class="weight-400 font-13">Study Start Date (*)</label>
							<div class="font-13 text-primary">When did/does the study start:</div>
	                		<select  required="required" name="start_date" id="start_date" class="form-control selectpicker" title="Nothing selected">
		                        <?php if (isset($starts) && $starts != false): ?>
			                        <?php foreach ($starts as $start):?>
			                          	<option value="<?=$start['id']?>"<?=($start['start_name'] == $study['start_date'])?'selected':''?>><?=$start['start_name']?></option>
			                        <?php endforeach;?>
		                        <?php endif?>
			                </select>
                            <span class="text-danger weight-400 font-13" id="js_error_startdate"></span>


                            <label for="other_start_date" class="weight-400 margin-top-30 font-13 <?=(isset($study['start_date_id']) && ($study['start_date_id'] =='10'))?'visible':'hidden1' ?>">Other Start Date</label>
                            <div class="font-13 margin-top-4 text-primary <?=(isset($study['start_date_id']) && ($study['start_date_id'] =='10'))?'visible':'hidden1' ?>">Please specify the other Start Date:</div>
                            <input type="text" value="<?=$study['start_date']?>" name="other_start_date" id="other_start_date" placeholder="Other Currecy" class="form-control <?=(isset($study['start_date_id']) && ($study['start_date_id'] =='10'))?'visible':'hidden1' ?>"/>
	                	</div>
	                	<div class="col-sm-6">
	                		<label for="end_date" class="weight-400 font-13">Study End Date (*)</label>
                            <div class="font-13 text-primary">When did/does the end start:</div>
                            <select  required="required" name="end_date" id="end_date" class="form-control selectpicker" title="Nothing selected">
                                <?php if (isset($ends) && $ends != false): ?>
                                    <?php foreach ($ends as $end):?>
                                    <option value="<?=$end['id']?>"<?=($end['end_name'] == $study['end_date'])?'selected':''?>><?=$end['end_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            <span class="text-danger js_error_enddate font-12 weight-400 font-13"></span>

                            <label for="other_end_date" class="weight-400 margin-top-30 font-13 <?=(isset($study['end_date_id']) && ($study['end_date_id'] =='10'))?'visible':'hidden1' ?>">Other End Date</label>
                            <div class="font-13 margin-top-4 text-primary <?=(isset($study['end_date_id']) && ($study['end_date_id'] =='10'))?'visible':'hidden1' ?>">Please specify the other End Date:</div>
                            <input type="text" value="<?=$study['end_date']?>" name="other_end_date" id="other_end_date" placeholder="Other Currecy" class="form-control <?=(isset($study['end_date_id']) && ($study['end_date_id'] =='10'))?'visible':'hidden1' ?>"/>
	                	</div>
	                </div>
                    <hr>
                </div>


                <div class="form-group padding-left-20 padding-right-20">
                	<div class="row">
                		<div class="col-sm-6">
                			<label for="contact_name" class="weight-400 font-13">Contact Name (*)</label>
							<div class="font-13 text-primary">Provide the name of key contact for this study:</div>
	                		<input  required="required" type="text" value="<?=$study['contact_name']?>" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name">
                		</div>
                		<div class="col-sm-6">
                			<label for="contact_email" class="weight-400 font-13">Contact Email (*)</label>
							<div class="font-13 text-primary">Provide the Email of key contact for this study:</div>
	                		<input required="required" type="email" class="form-control" value="<?=$study['contact_email']?>" id="contact_email" name="contact_email" placeholder="Contact Email">
                		</div>
                	</div>
                </div>

                <div class="form-group padding-left-20 padding-right-20 margin-bottom-20">
                    <div class="row">
	                    <div class=" col-sm-6">
                            <input type="hidden" name="editStudy" value="Save Study" >
	                        <input type="submit" id="addStudy" value="Save Study" class="btn btn-block btn-primary"/>
	                    </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script>
var site_url = "<?=site_url();?>";
var get_sector = "<?=site_url('dashboard/getThemesFromStudies/'.$study['id']);?>";
</script>
<?php $this->load->view('dashboard/footer');?>
