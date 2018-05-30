<?php $this->load->view('dashboard/header');?>
<div class="container ">
<?php echo validation_errors();?>
    <div class="row margin-bottom-20">
        <form  id="addStudyForm" method="POST" action="<?=site_url('dashboard/addStudy');?>">
            <fieldset class="bg-white shadow">
                <div class="h2 text-center bg-red text-grey no-margin padding-10">MER List of Studies 2016</div>
                <div class="h3 text-left bg-white padding-left-20  padding-bottom-10">Study Details</div>

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="agency" class="weight-400 font-13">Agency</label>
                            <div class="font-13 text-primary">Your Agency Name:</div>
                            <input type="text" disabled class="form-control" value="<?=$this->session->agency_name;?>">
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="title" class="weight-400 font-13">Study Title (*)</label>
                            <div class="font-13 text-primary">Please provide the title of the study:</div>
                            <textarea required="required" rows="5" id="title" name="title" class="form-control" placeholder="Study Title"><?=set_value('title')?></textarea>
                            <?php if(null != (form_error('title'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('title')?>
                            </span>
                            <?php endif;?>
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
                                    <option value="<?=$country['id']?>"<?=set_select('country', $country['id'])?>><?=$country['country_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            <?php if(null != (form_error('country'))):?>
                                <span class="text-danger weight-400 font-13">
                                    <?=form_error('country')?>
                                </span>
                            <?php endif;?>

                            <label for="other_country" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_country))?'visible':'hidden1' ?>">Other country(ies)</label>
                            <div class="font-13  text-primary <?=(null !== ($this->session->other_country))?'visible':'hidden1' ?>">Please specify the other country(ies) which the study covers:</div>
                            <textarea name="other_country" required="required" id="other_country" class="form-control <?=(null !== ($this->session->other_country))?'visible':'hidden1' ?>"  placeholder="Other country(ies)"><?=set_value('other_country')?></textarea>
                            <?php if(null!=(form_error('other_country'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('other_country')?></span>
                            <?php endif;?>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="sub_location" class="weight-400 font-13">Sub-national Location</label>
                            <div class="font-13 text-primary">Provide the sub-national location(s) within the country(ies) :</div>
                            <textarea id="sub_location" rows="5" name="sub_location" class="form-control" placeholder="Sub-national Location"><?=set_value('sub_location')?></textarea>
                            <?php if(null != (form_error('sub_location'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('sub_location')?></span>
                            <?php endif;?>
                        </div>

                        
                    </div>
                    <hr>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                    	<div class="col-sm-6">
                    		<label for="sector" class="weight-400 font-13">Sector (*)</label>
		                    <div class="font-13 text-primary">Please provide the sector(s) which the study covers:</div>
	                        <select  multiple required="required" name="sector[]" id="sector" class="selectpicker form-control">
	                            <?php if (isset($sectors) && $sectors != false): ?>
		                            <?php foreach ($sectors as $sector):?>
		                            <option value="<?=$sector['id']?>"<?=set_select('sector', $sector['id'])?>><?=$sector['sector_name']?></option>
		                            <?php endforeach;?>
	                            <?php endif?>
	                        </select>
	                        <?php if(null != (form_error('sector'))):?>
	                        <span class="text-danger weight-400 font-13">
	                            <?=form_error('sector')?>
	                        </span>
	                        <?php endif;?>

                            
                            <label for="other_sector" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_sector))?'visible':'hidden1' ?>">Other Sectors</label>
                            <div class="font-13  text-primary <?=(null !== ($this->session->other_sector))?'visible':'hidden1' ?>">
                                Please specify the other sector(s) which the study covers:
                            </div>
                            <textarea name="other_sector" required="required" id="other_sector" class="form-control <?=(null !== ($this->session->other_sector))?'visible':'hidden1' ?>"  placeholder="Other Sectors"><?=set_value('other_sector')?></textarea>
                            <?php if(null!=(form_error('other_sector'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('other_sector')?>
                            </span>
                            <?php endif;?>
	                    </div>

	                    <div class="col-sm-6">
		                    <label for="theme" class="weight-400 font-13">Themes (*)</label>
                            <div class="font-13 text-primary">Please provide the thematic area(s)  which the study covers:</div>
                            <select multiple required="required" name="theme[]" id="theme" class="form-control selectpicker"></select>
                            <?php if(null != (form_error('theme'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('theme')?></span>
                            <?php endif;?>

                            <label for="other_theme" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_theme))?'visible':'hidden1' ?>">Other Themes</label>
                            <div class="font-13 text-primary <?=(null !== ($this->session->other_theme))?'visible':'hidden1' ?>">
                                Please specify the other sector(s) which the study covers:
                            </div>
                            <textarea name="other_theme" id="other_theme" class="form-control <?=(null !== ($this->session->other_theme))?'visible':'hidden1' ?>"  placeholder="Other Themes"><?=set_value('other_theme')?></textarea>
                            <?php if(null!=(form_error('other_theme'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('other_theme')?>
                            </span>
                            <?php endif;?>
	                    </div>
                    </div>
                    <hr>
                </div>

                

                <div class="form-group padding-left-20 padding-right-20">
                	<div class="row">
                		<div class="col-sm-6">
                			<label for="objectives" class="weight-400 font-13">Study Objectives (*)</label>
		                    <div class="font-13 text-primary">Please provide the objective(s) of the study:</div>
		                    <textarea  required="required" rows='5' id="objectives" name="objectives" class="form-control"><?=set_value('objectives')?></textarea>
	                        <?php if(null != (form_error('objectives'))):?>
	                        <span class="text-danger weight-400 font-13">
	                            <?=form_error('objectives')?>
	                        </span>
	                        <?php endif;?>
                		</div>
                        <div class="col-sm-6">
                            <label for="study_status" class="weight-400 font-13">Study Status (*)</label>
                            <div class="font-13 text-primary">Provide the study status:</div>
                            <select required="required" name="study_status" id="study_status" class="form-control selectpicker" title="Nothing Selected">
                                <?php if (isset($statuses) && $statuses != false): ?>
                                    <?php foreach ($statuses as $status):?>
                                        <option value="<?=$status['id']?>"<?=set_select('study_status', $status['id'])?>><?=$status['status_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            <?php if(null != (form_error('study_status'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('study_status')?>
                            </span>
                            <?php endif;?>


                            <label for="other_status" class="weight-400 margin-top-15 hide font-13 <?=(null !== ($this->session->other_status))?'visible':'hidden' ?>">Other status</label>
                            <div class="font-13 hide text-primary <?=(null !== ($this->session->other_status))?'visible':'hidden' ?>">
                                Please specify the other sector(s) which the study covers:
                            </div>
                            <input name="other_status" id="other_status" class="form-control <?=(null !== ($this->session->other_status))?'visible':'hidden' ?> hide"  placeholder="Other status" value="<?=set_value('other_status')?>">
                            <?php if(null!=(form_error('other_status'))):?>
                            <span class="text-danger hide weight-400 font-13">
                                <?=form_error('other_status')?>
                            </span>
                            <?php endif;?>

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
		                            	<option value="<?=$method['id']?>" <?=set_select('tools[]', $method['id'])?>><?=$method['method_name']?></option>
		                            <?php endforeach;?>
	                            <?php endif;?>
	                        </select>
	                        <?php if(null != (form_error('tools[]'))):?>
	                        <span class="text-danger weight-400 font-13">
	                            <?=form_error('tools[]')?>
	                        </span>
                        	<?php endif;?>

                            <label for="other_tools" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_tools))?'visible':'hidden1' ?>">Other Methods and Tools</label>
                            <div class="font-13 margin-top-4 text-primary <?=(null !== ($this->session->other_tools))?'visible':'hidden1' ?>">Please specify other methods and tools to be used in the study:</div>
                            <textarea name="other_tools" id="other_tools" placeholder="Other Methods and Tools" class="form-control <?=(null !== ($this->session->other_tools))?'visible':'hidden1' ?>"><?=set_value('other_tools')?></textarea>
                            <?php if(null!=(form_error('other_tools'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('other_tools')?>
                            </span>
                            <?php endif;?>

                		</div>
                		<div class="col-sm-6 ">
                			<label for="collaboration_radio" class="weight-400 font-13">AKDN Collabration(*)</label>
                            <div class="font-13 text-primary">Is the study conducted in collaboration with other AKDN agency(ies)?</div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="collaboration_radio" id="collaboration_radio">
                                    Other Agencies Collaborating?
                                </label>
                            </div>
                            

                            <label for="collaborators" class=" weight-400 margin-top-30 font-13">Other Collaborating Agencies</label>
                            <div class="font-13 text-primary ">Please select all the AKDN agencies you are collaborating with in this study:</div>
                            <select multiple name="collaborators[]" id="collaborators" class="selectpicker form-control ">
                                <?php if (isset($agencies) && $agencies != false): ?>
                                    <?php foreach ($agencies as $agency):?>
                                        <option value="<?=$agency['id']?>" <?=set_select('collaborators', $agency['id'])?>><?=$agency['agency_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            <?php if(null != (form_error('collaborators'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('collaborators')?>
                            </span>
                            <?php endif;?>

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
	                            	<option value="<?=$currency['id']?>" <?=set_select('budget', $currency['id'])?>><?=$currency['currency_name']?></option>
	                            <?php endforeach;?>
	                            <?php endif?>
	                        </select>
                        	<?php if(null!=(form_error('budget'))):?>
	                        <span class="text-danger weight-400 font-13">
	                            <?=form_error('budget')?>
	                        </span>
	                        <?php endif;?>

                            <label for="other_currency" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_currency))?'visible':'hidden1' ?>">Other Currency</label>
                            <div class="font-13 text-primary <?=(null !== ($this->session->other_currency))?'visible':'hidden1' ?>">Please specify the other currency:</div>
                            <input type="text" value="<?=set_value('other_currency')?>" name="other_currency" id="other_currency" placeholder="Other Currecy" class="form-control <?=(null !== ($this->session->other_currency))?'visible':'hidden1' ?>"/>
                            <?php if(null!=(form_error('other_currency'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('other_currency')?></span>
                            <?php endif;?>
                		</div>
                		
                		<div class="col-sm-6">
                			<label for="amount" class="weight-400 font-13">Total Budget (*)</label>
                			<div class="font-13 text-primary">Please provide the total budget amount for the study:</div>
                			<input type="text" name="amount" value="<?= set_value('amount');?>" class="form-control" id="amount" placeholder="e.g. 10000"/>
	                        <?php if(null!=(form_error('amount'))):?>
	                        <span class="text-danger weight-400 font-13">
	                            <?=form_error('amount')?>
	                        </span>
	                        <?php endif;?>
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
	                            <option value="1"<?=set_select('fund_source', "1")?>>Internal</option>
	                            <option value="2"<?=set_select('fund_source', "2")?>>External</option>
	                        </select>
	                        <?php if(null != (form_error('fund_source'))):?>
	                        <span class="text-danger weight-400 font-13"><?=form_error('fund_source')?></span>
	                        <?php endif;?>

                            <label for="other_fund" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_fund))?'visible':'hidden1' ?>">Other Funding Sources</label>
                            <div class="font-13 margin-top-4 text-primary <?=(null !== ($this->session->other_fund))?'visible':'hidden1' ?>">Please specify the external funding source/name:</div>
                            <textarea name="other_fund" class="form-control <?=(null !== ($this->session->other_fund))?'visible':'hidden1' ?>" id="other_fund" placeholder="Other External Funders"><?=set_value('other_fund')?></textarea>
                            <?php if(null!=(form_error('other_fund'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('other_fund')?></span>
                            <?php endif;?>


						</div>
						<div class="col-sm-6">
							<label for="human_resource[]" class="weight-400 font-13">Human Resource (*)</label>
                            <div class="font-13 text-primary">Please select the human resources involved in this study:</div>
                            <select multiple required="required" name="human_resource[]" id="human_resource" class="form-control selectpicker">
                                <option value="1"<?=set_select('human_resource[]', "1")?>>Internal</option>
                                <option value="2"<?=set_select('human_resource[]', "2")?>>External</option>
                            </select>
                            <?php if(null != (form_error('human_resource[]'))):?>
                            <span class="text-danger weight-400 font-13"><?=form_error('human_resource[]')?></span>
                            <?php endif;?>

                            <label for="other_hr" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_hr))?'visible':'hidden1' ?>">Other Human Reources</label>
                            <div class="font-13 margin-top-4 text-primary <?=(null !== ($this->session->other_hr))?'visible':'hidden1' ?>">Please specify the external human resources:</div>
                            <textarea name="other_hr" class="form-control <?=(null !== ($this->session->other_hr))?'visible':'hidden1' ?>" id="other_hr" placeholder="Other Human Resources"><?=set_value('other_hr')?></textarea>
                            <?php if(null!=(form_error('other_hr'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('other_hr')?></span>
                            <?php endif;?>                            
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
			                            	<option value="<?=$start['id']?>"<?=set_select('start_date', $start['id'])?>><?=$start['start_name']?></option>
			                            <?php endforeach;?>
		                            <?php endif?>
			                    </select>
                                <span class="text-danger weight-400 font-13" id="js_error_startdate"></span>
			                    <?php if(null != (form_error('start_date'))):?>
			                      	<span class="text-danger weight-400 font-13"><?=form_error('start_date')?></span>
			                    <?php endif;?>
                                



                            <label for="other_start_date" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_start_date))?'visible':'hidden1' ?>">Other Start Date</label>
                            <div class="font-13 margin-top-4 text-primary <?=(null !== ($this->session->other_start_date))?'visible':'hidden1' ?>">Please specify the other Start Date:</div>
                            <input type="text" value="<?=set_value('other_start_date')?>" name="other_start_date" id="other_start_date" placeholder="Please Provide Other Start Date" class="form-control <?=(null !== ($this->session->other_start_date))?'visible':'hidden1' ?>"/>
                            <?php if(null!=(form_error('other_start_date'))):?>
                                <span class="text-danger weight-400 font-13">
                                    <?=form_error('other_start_date')?>
                                </span>
                            <?php endif;?>


	                	</div>
	                	<div class="col-sm-6">
	                		<label for="end_date" class="weight-400 font-13">Study End Date (*)</label>
                            <div class="font-13 text-primary">When did/does the end start:</div>
                            <select  required="required" name="end_date" id="end_date" class="form-control selectpicker" title="Nothing selected">
                                <?php if (isset($ends) && $ends != false): ?>
                                <?php foreach ($ends as $end):?>
                                <option value="<?=$end['id']?>"<?=set_select('end_date', $end['id'])?>><?=$end['end_name']?></option>
                                <?php endforeach;?>
                                <?php endif?>
                            </select>
                            <span class="text-danger weight-400 font-13" id="js_error_enddate"></span>
                            <?php if(null != (form_error('end_date'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('end_date')?></span>
                            <?php endif;?>
                            



                            <label for="other_end_date" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_end_date))?'visible':'hidden1' ?>">Other End Date</label>
                            <div class="font-13 margin-top-4 text-primary <?=(null !== ($this->session->other_end_date))?'visible':'hidden1' ?>">Please specify the other End Date:</div>
                            <input type="text" value="<?=set_value('other_end_date')?>" name="other_end_date" id="other_end_date" placeholder="Please Provide Other End Date" class="form-control <?=(null !== ($this->session->other_end_date))?'visible':'hidden1' ?>"/>
                            <?php if(null!=(form_error('other_end_date'))):?>
                                <span class="text-danger weight-400 font-13">
                                    <?=form_error('other_end_date')?>
                                </span>
                            <?php endif;?>

	                	</div>
	                </div>
                    <hr>
                </div>


                

                <div class="form-group padding-left-20 padding-right-20">
                	<div class="row">
                		<div class="col-sm-6">
                			<label for="contact_name" class="weight-400 font-13">Contact Name (*)</label>
							<div class="font-13 text-primary">Provide the name of key contact for this study:</div>
	                		<input  required="required" type="text" value="<?=set_value('contact_name')?>" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name">
	                        <?php if(null != (form_error('contact_name'))):?>
	                        <span class="text-danger weight-400 font-13">
	                            <?=form_error('contact_name');?>
	                        </span>
	                        <?php endif;?>
                		</div>
                		<div class="col-sm-6">
                			<label for="contact_email" class="weight-400 font-13">Contact Email (*)</label>
							<div class="font-13 text-primary">Provide the Email of key contact for this study:</div>
	                		<input required="required" type="email" class="form-control" value="<?=set_value('contact_email')?>" id="contact_email" name="contact_email" placeholder="Contact Email">
	                        <?php if(null != (form_error('contact_email'))):?>
	                        <span class="text-danger weight-400 font-13">
	                            <?=form_error('contact_email');?>
	                        </span>
	                        <?php endif;?>
                		</div>
                	</div>
                </div>
                <!-- <div class="form-group padding-left-20 padding-right-20">
	                <div class="row">
	                    <div class="col-sm-6">
	                        <label for="description" class="weight-400 font-13">Additional Details (*)</label>
							<div class="font-13 text-primary">Please feel free to add any additional comments regarding this study:</div>
		                	<textarea name="description" class="form-control " id="description" placeholder="Additional Notes"><?=set_value('description')?></textarea>
		                    <?php if(null!=(form_error('description'))):?>
		                        <span class="text-danger weight-400 font-13"><?=form_error('description')?></span>
		                    <?php endif;?>
	                    </div>
                    </div>
                </div> -->
                <div class="form-group padding-left-20 padding-right-20 margin-bottom-20">
                    <div class="row">
	                    <div class=" col-sm-6">
                            <input type="hidden" name="addStudy" value="studyAdd">
	                        <input type="submit" id="addStudy"  value="Save Study" class="btn btn-block btn-primary"/>
	                    </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script>
var site_url = "<?=site_url();?>";
</script>
<?php $this->load->view('dashboard/footer');?>
