<?php $this->load->view('dashboard/header');?>
<div class="container ">
<?php //echo validation_errors();?>
    <div class="row margin-bottom-20">
        <form  id="addStudyForm" method="POST" action="<?=site_url('dashboard/addStudy');?>">
            <fieldset class="bg-white shadow">
                <div class="h2 text-center bg-red text-grey no-margin padding-10">List of MER Studies 2016-2017</div>
                <div class="h3 text-left bg-white padding-left-20  padding-bottom-10">Please provide the details of the study in the fields below</div>
                <div class="h7 text-left bg-white padding-left-20  padding-bottom-10 text-primary">NOTE: Fields marked with  an asterisk (*) are required</div>
                
                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="agency" class="weight-400 font-13">1. Your agency name:</label>
                            <input type="text" disabled class="form-control font-12" value="<?=$this->session->agency_name;?>">
							</div>
                        </div>
                    <hr>
                </div>  
                
                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">        
                        <div class="col-sm-6">
                            <label for="title" class="weight-400 font-13">2. Please provide the official title of the study: (*)</label>
                            <textarea required="required" rows="5" id="title" name="title" class="form-control font-12" placeholder="(e.g. Food Security and Income Mid-Term Review)"><?=set_value('title')?></textarea>
                            <?php if(null != (form_error('title'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('title')?>
                            </span>
                            <?php endif;?>
                        </div>
                        <div class="col-sm-6">
                            <label for="study_status" class="weight-400 font-13">3. Please provide the study status: (*)</label>
                                <select required="required" name="study_status" id="study_status" class="form-control selectpicker" title="(e.g. planned, on-going, extended)">
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


                            <!-- <label for="other_status" class="weight-400 margin-top-15 hide font-13 <?php //(null !== ($this->session->other_status))?'visible':'hidden' ?>">Please specify the other study status:</label>
                            <div class="font-13 hide text-primary <?php //(null !== ($this->session->other_status))?'visible':'hidden' ?>">Other status</div>
                            <input name="other_status" id="other_status" class="form-control <?php //(null !== ($this->session->other_status))?'visible':'hidden' ?> hide"  placeholder="Other status" value="<?php //set_value('other_status')?>">
                            <?php// if(null!=(form_error('other_status'))):?>
                            <span class="text-danger hide weight-400 font-13">
                                <?php //form_error('other_status')?>
                            </span>
                            <?php //endif;?> -->

                        </div>
                    </div>
                    <hr>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                    <div class="col-sm-6">
                            <label for="country" class="weight-400 font-13 ">4. Please provide the country(ies) where this study is being conducted: (*)</label>
                            <select  multiple required="required" name="country[]" id="country" class="selectpicker form-control" title="(select all that apply)">
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

                            <label for="other_country" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_country))?'visible':'hidden1' ?>">4(a). Please specify the other country(ies) which the study covers:</label>
                            <textarea name="other_country" required="required" id="other_country" placeholder="(list other country(ies) separated by commas)" class="form-control <?=(null !== ($this->session->other_country))?'visible':'hidden1' ?> font-12"><?=set_value('other_country')?></textarea>
                            <?php if(null!=(form_error('other_country'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('other_country')?></span>
                            <?php endif;?>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="sub_location" class="weight-400 font-13">5. Please provide the sub-national location(s) within the country(ies):</label>
                            <textarea id="sub_location" rows="7" name="sub_location" class="form-control font-12" placeholder="(e.g. Kilwa district, Bamyan province, Mopti cercle - separate by commas if several)"><?=set_value('sub_location')?></textarea>
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
                            <label for="sector" class="weight-400 font-13">6. Please provide the thematic area(s) which the study covers: (*)</label>
                            <select  multiple required="required" name="sector[]" id="sector" class="form-control font-12 selectpicker" title="(select all that apply)">
                                <?php if (isset($sectors) && $sectors != false): ?>
                                    <?php foreach ($sectors as $sector):?>
                                    <option value="<?=$sector['id']?>"<?=set_select('sector', $sector['id'])?>><?=$sector['sector_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            <?php if (null != (form_error('sector'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('sector')?>
                            </span>
                            <?php endif;?>

                            <label for="other_sector" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_sector)) ? 'visible' : 'hidden1' ?>">6(a). Please specify the other thematic area(s) which the study covers:</label>
                            <textarea name="other_sector" required="required" id="other_sector" placeholder="(list other thematic area(s) separated by commas)" class="form-control <?=(null !== ($this->session->other_sector)) ? 'visible' : 'hidden1' ?> font-12" ><?=set_value('other_sector')?></textarea>
                            <?php if (null != (form_error('other_sector'))):?>
                            <span class="text-danger weight-400 font-13">
								<?=form_error('other_sector')?>
                            </span>
                            <?php endif;?>

                        </div>
                    </div>
                </div> 

                             

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="objectives" class="weight-400 font-13">7. Please provide the objective(s) of the study: (*)</label>
                              <textarea  required="required" rows='7' id="objectives" name="objectives" class="form-control font-12" placeholder="(state the key questions to be addressed e.g. Identify the QoL outcomes of loans from AKAM for repeat clients; Evaluate the outcomes from a chronic disease intervention programme)"><?=set_value('objectives')?></textarea>
                            <?php if(null != (form_error('objectives'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('objectives')?>
                            </span>
                            <?php endif;?>
                        </div>
                        <div class="col-sm-6">
                            <label for="tools[]" class="weight-400 font-13">8. Please provide the main methods and tools to be used in the study: (*)</label>
                                <select multiple required="required" name="tools[]" id="tools" class="form-control selectpicker" title="(select all that apply)">
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

                            <label for="other_tools" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_tools))?'visible':'hidden1' ?>">8(a). Please specify other methods and tools to be used in the study:</label>
                            <textarea name="other_tools" id="other_tools" placeholder="(list other methods and tools separated by commas)" class="form-control <?=(null !== ($this->session->other_tools))?'visible':'hidden1' ?> font-12"><?=set_value('other_tools')?></textarea>
                            <?php if(null!=(form_error('other_tools'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('other_tools')?>
                            </span>
                            <?php endif;?>

                        </div>
                      </div>
                    <hr>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6 ">
                            <label for="collaboration_radio" class="weight-400 font-13">9. Is the study conducted in collaboration with other AKDN or external agency(ies)? (*)</label>
                                <!-- <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="collaboration_radio" id="collaboration_radio"> Other Agencies Collaborating?
                                </label>
                            </div> -->
                            <select multiple required="required" name="collaboration_radio[]" id="collaboration_radio" class="form-control selectpicker" title="(select all that apply)">
                                <option value="0"<?=set_select('collaboration_radio', "0")?>>None</option>
                                <option value="1"<?=set_select('collaboration_radio', "1")?>>AKDN agency</option>
                                <option value="2"<?=set_select('collaboration_radio', "2")?>>External agency</option>
                            </select>


                            <label for="collaborators" class=" weight-400 margin-top-30 font-13">9(a). Please select all the AKDN agencies you are collaborating with in this study:</label>
                            <select multiple name="collaborators[]" id="collaborators" class="selectpicker form-control" title="(select all that apply)">
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
                        <div class="col-sm-6">
                            <label for="other_collaborators" class="weight-400 font-13">9(b). Please specify the other external agencies you are collaborating with in this study:</label>
                            <input type="text" value="<?=set_value('other_collaborators')?>" name="other_collaborators" id="other_collaborators" placeholder="(specify the other external agencies you are collaborating with if known)" class="form-control <?=(null !== ($this->session->other_collaborators))?'visible':'hidden1' ?> font-12"/>
                            <?php if(null!=(form_error('other_collaborators'))):?>
                                <span class="text-danger weight-400 font-13">
                                    <?=form_error('other_collaborators')?>
                                </span>
                            <?php endif;?>
                        </div>
                    </div>
                    <hr>
                </div>
                
                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="start_date" class="weight-400 font-13">10. Please select the study start date: (*)</label>
                            <select  required="required" name="start_date" id="start_date" class="form-control selectpicker" title="(when did/does the study start? e.g. Q3-2016)">
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
                                
                            <label for="other_start_date" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_start_date))?'visible':'hidden1' ?>">10(a). Please specify the other start date of the study:</label>
                            <input type="text" value="<?=set_value('other_start_date')?>" name="other_start_date" id="other_start_date" placeholder="(specify the other start date as a quarter if known e.g. Q3-2015)" class="form-control <?=(null !== ($this->session->other_start_date))?'visible':'hidden1' ?> font-12"/>
                            <?php if(null!=(form_error('other_start_date'))):?>
                                <span class="text-danger weight-400 font-13">
                                    <?=form_error('other_start_date')?>
                                </span>
                            <?php endif;?>
                        </div>
                        <div class="col-sm-6">
                            <label for="end_date" class="weight-400 font-13">11. Please select the study end date: (*)</label>
                            <select  required="required" name="end_date" id="end_date" class="form-control selectpicker" title="(when did/does the study end? e.g. Q1-2017)">
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

                            <label for="other_end_date" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_end_date))?'visible':'hidden1' ?>">11(a). Please specify the other end date of the study:</label>
                            <input type="text" value="<?=set_value('other_end_date')?>" name="other_end_date" id="other_end_date" placeholder="(specify the other end date as a quarter if known e.g. Q2-2018)" class="form-control <?=(null !== ($this->session->other_end_date))?'visible':'hidden1' ?> font-12"/>
                            <?php if(null!=(form_error('other_end_date'))):?>
                                <span class="text-danger weight-400 font-13">
                                    <?=form_error('other_end_date')?>
                                </span>
                            <?php endif;?>
                        </div>
                    </div>
                    <hr>
                </div>

            </fieldset>


            <fieldset class="bg-white shadow margin-top-20">
                <div class="h3 text-left bg-white padding-bottom-10 margin-left-30">Funding and Human Resources</div>
                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="budget" class="weight-400 font-13">12. Please provide the currency code for study budget: </label>
                             <select  name="budget" id="budget" class="form-control selectpicker" title="(select the budget currency e.g. USD)">
                                <option value="" selected='selected' >None</option>
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

                            <label for="other_currency" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_currency))?'visible':'hidden1' ?>">12(a). Please specify the other currency for study budget:</label>
                            <input type="text" value="<?=set_value('other_currency')?>" name="other_currency" id="other_currency" placeholder="(specify the other budget currency e.g. Indian Rupees)" class="form-control <?=(null !== ($this->session->other_currency))?'visible':'hidden1' ?> font-12"/>
                            <?php if(null!=(form_error('other_currency'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('other_currency')?></span>
                            <?php endif;?>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="amount" class="weight-400 font-13">13. Please provide the total budget amount for the study: </label>
                            <input type="text" name="amount" value="<?= set_value('amount');?>" class="form-control font-12" id="amount" placeholder="(Please provide the entire total budget for the study e.g. 10000)"/>
                            <?php if(null!=(form_error('amount'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('amount')?>
                            </span>
                            <?php endif;?>
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="amount_2016" class="weight-400 margin-top-30 font-13">13(a). Please provide the total budget amount for 2016 (if possible):</label>
                                </div>
                                <!-- <div class="col-sm-4">
                                    <div class="checkbox"><label><input name ="rgister_2016" id="register_2016" type="checkbox">Register 2016 Budget</label></div>
                                </div> -->
                                <div class="col-sm-12">
                                    <input type="text" name="amount_2016" value="<?= set_value('amount_2016');?>" class="form-control font-12" id="amount_2016" placeholder="(Please provide budget allocation for 2016 for the study e.g. 5000)"/>
                                </div>
                            </div>
                            
                          
                        </div>
                    </div>
                    <hr>
                </div>


                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="fund_source" class="weight-400 font-13">14. Please provide the source(s) of funding for the study: (*)</label>
                            <select multiple required="required" name="fund_source[]" id="fund_source" class="form-control selectpicker" title="(select all that apply)">
                                <option value="1"<?=set_select('fund_source', "1")?>>Internal to your agency</option>
								<option value="3"<?=set_select('fund_source', "3")?>>Another AKDN agency</option>
                                <option value="2"<?=set_select('fund_source', "2")?>>External funding</option>
                            </select>
                            <?php if(null != (form_error('fund_source'))):?>
                            <span class="text-danger weight-400 font-13"><?=form_error('fund_source')?></span>
                            <?php endif;?>

                            <label for="other_fund" class="weight-400 margin-top-30 font-13 <?=(null !== ($this->session->other_fund))?'visible':'hidden1' ?>">14(a). Please specify the external funding source/name:</label>
                            <textarea name="other_fund" class="form-control <?=(null !== ($this->session->other_fund))?'visible':'hidden1' ?> font-12" id="other_fund" placeholder="(specify the source of external funding e.g. USAID, DFID)"><?=set_value('other_fund')?></textarea>
                            <?php if(null!=(form_error('other_fund'))):?>
                                <span class="text-danger weight-400 font-13"><?=form_error('other_fund')?></span>
                            <?php endif;?>


                        </div>
                        <div class="col-sm-6">
                            <label for="human_resource[]" class="weight-400 font-13">15. Please select the human resources involved in this study: (*)</label>
                            <select multiple required="required" name="human_resource[]" id="human_resource" class="form-control selectpicker" title="(select all that apply)">
                                <option value="1"<?=set_select('human_resource[]', "1")?>>Internal to your agency</option>
								<option value="3"<?=set_select('human_resource[]', "3")?>>Another AKDN agency</option>
                                <option value="2"<?=set_select('human_resource[]', "2")?>>External to your agency</option>
                            </select>
                            <?php if(null != (form_error('human_resource[]'))):?>
                            <span class="text-danger weight-400 font-13"><?=form_error('human_resource[]')?></span>
                            <?php endif;?>

                            <!-- <label for="other_hr" class="weight-400 margin-top-30 font-13 <?php //(null !== ($this->session->other_hr))?'visible':'hidden1' ?>">16. Please specify the external human resources:</label>
                            <textarea name="other_hr" class="form-control <?php //(null !== ($this->session->other_hr))?'visible':'hidden1' ?>" id="other_hr" placeholder="Other Human Resources"><?=set_value('other_hr')?></textarea>
                            <?php //if(null!=(form_error('other_hr'))):?>
                                <span class="text-danger weight-400 font-13"><?php //form_error('other_hr')?></span>
                            <?php //endif;?>   -->                          
                        </div>
                    </div>
                    <hr>
                </div>

                           

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="contact_name" class="weight-400 font-13">16. Please provide the name of key contact for this study: (*)</label>
                            <input  required="required" type="text" value="<?=set_value('contact_name')?>" class="form-control font-12" id="contact_name" name="contact_name" placeholder="(provide the name(s) of the study's key contact)">
                            <?php if(null != (form_error('contact_name'))):?>
                            <span class="text-danger weight-400 font-13">
                                <?=form_error('contact_name');?>
                            </span>
                            <?php endif;?>
                        </div>
						<div class="col-sm-6">
                            <label for="contact_email" class="weight-400 font-13">17. Please provide the email of key contact for this study: (*)</label>
                            <input required="required" type="email" class="form-control font-12" value="<?=set_value('contact_email')?>" id="contact_email" name="contact_email" placeholder="(provide the email address of the study's key contact)">
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
                            <textarea name="description" class="form-control " id="description" placeholder="Additional Notes"><?php //set_value('description')?></textarea>
                            <?php //if(null!=(form_error('description'))):?>
                                <span class="text-danger weight-400 font-13"><?php //echo form_error('description')?></span>
                            <?php //endif;?>
                        </div>
                    </div>
                </div> -->
                <div class="form-group padding-left-20 padding-right-20 margin-bottom-20">
                    <div class="row">
                        <div class=" col-sm-2">
                            <button type="button" id="saveStudy" class="btn btn-block btn-info">Save Study Partially</button>
                        </div>
                        <div class=" col-sm-2">
                            <input type="hidden" name="addStudy" value="studyAdd">
                            <input type="submit" id="addStudy"  value="Submit Study" class="btn btn-block btn-success"/>
                        </div>
                    </div>
                </div>
				<div class="form-group padding-left-20 padding-right-20 margin-bottom-20">
					<div class="row">
                        <div class="col-sm-6">
						<label for="description" class="weight-400 font-13">NOTE:</label>
                        <div class="font-13 text-primary">Partially-saved studies are only saved on your computer. In order for the study to be included in the MER studies database and considered for analysis, please use the “Submit Study” button. 
							You can edit submitted studies using the edit function on the “HOME” screen. You can access any partially saved study from the “PARTIALLY SAVED STUDIES” tab at the top of the main screen.</div>
				</div>
            </fieldset>
        </form>
    </div>
</div>
<script>
var site_url = "<?=site_url();?>";
</script>
<?php $this->load->view('dashboard/footer');?>