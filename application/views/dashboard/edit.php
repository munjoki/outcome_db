<?php $this->load->view('dashboard/header');?>
<div class="container ">
    <div class="row margin-bottom-20">
        <form  id="addStudyForm" method="POST" action="<?=site_url('dashboard/update');?>">
            <fieldset class="bg-white shadow">
                <div class="h2 text-center bg-red text-grey no-margin padding-10">List of MER Studies 2016-2017</div>
                <div class="h3 text-left bg-white padding-left-20  padding-bottom-10">Please provide the details of the study in the fields below</div>
                <div class="h7 text-left bg-white padding-left-20  padding-bottom-10 text-primary">NOTE: Fields marked with  an asterisk (*) are required</div>
                
                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="agency" class="weight-400 font-13">1. Your agency name:</label>
                            <!-- <div class="font-13 text-primary">Your Agency Name:</div> -->
                            <input type="text" disabled class="form-control" value="<?=$study['agency_name'];?>">
                            <input type='hidden' name="study_identification" value="<?=$study['id']?>"/>
                        </div>
                    </div>
                    <hr>
                </div>
                
                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="title" class="weight-400 font-13">2. Please provide the official title of the study: (*)</label>
                            <!-- <div class="font-13 text-primary">Please provide the title of the study:</div> -->
                            <textarea required="required" rows="5" id="title" name="title" class="form-control font-12" placeholder="Study Title"><?=$study['title'];?></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label for="study_status" class="weight-400 font-13">3. Please provide the study status: (*)</label>
                            <!-- <div class="font-13 text-primary">Provide the study status:</div> -->
                            <select required="required" name="study_status" id="study_status" class="form-control selectpicker" title="(e.g. planned, on-going, extended)">
                                <?php if (isset($statuses) && $statuses != false): ?>
                                    <?php foreach ($statuses as $status):?>
									<option value="<?=$status['id']?>"  <?=($status['id'] == $study['study_id'])?'selected':''?> ><?=$status['status_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            
                            <!-- <label for="other_status" class="hide weight-400 margin-top-15 font-13">Other Status (*)</label>
                            <div class="font-13 hide text-primary">Other Status:</div>
                            <input type="text" name="other_status" value="<?php //$study['other_status'];?>" class="form-control hide" id="other_status" placeholder="Other Status"/> -->
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
                                        <?php if(isset($study['country_id'][0]) && $study['country_id'][0] == 'id'): ?>
                                           <option value="<?=$country['id']?>" <?=(in_array($country['id'],$study['country_id'][1]))?'selected':''?> >
                                                <?=$country['country_name']?>
                                            </option>
                                         <?php else: ?>
                                            <option value="<?=$country['id']?>" <?=(in_array($country['id'],$study['country_id']))?'selected':''?> >
                                                <?=$country['country_name']?>
                                            </option>
                                         <?php endif; ?>  
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>

                            <label for="other_country" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_country']) && !empty($study['other_country']))?'visible':'hidden1' ?>">4(a). Please specify the other country(ies) which the study covers:</label>
                            <textarea name="other_country" required="required" id="other_country" class="form-control <?=(isset($study['other_country']) && !empty($study['other_country']))?'visible':'hidden1' ?>"  placeholder="(list other country(ies) separated by commas)"><?=$study['other_country']?></textarea>
                        </div>
							
                        <div class="col-sm-6">
                            <label for="sub_location" class="weight-400 font-13">5. Please provide the sub-national location(s) within the country(ies):</label>
                            <textarea rows="6" id="sub_location" name="sub_location" class="form-control font-12" placeholder="(e.g. Kilwa district, Bamyan province, Mopti cercle - separate by commas if several)"><?=$study['sub_location'];?></textarea>
                        </div>
                    </div>
                    <hr>
                </div>
				
				<div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="sector" class="weight-400 font-13">6. Please provide the thematic area(s) which the study covers: (*)</label>
                            <select  multiple required="required" name="sector[]" id="sector" class="selectpicker form-control" title="(select all that apply)">
                                <?php if (isset($sectors) && $sectors != false): ?>
                                    <?php foreach ($sectors as $sector):?>
                                        <option value="<?=$sector['id']?>" <?=(in_array($sector['id'],$study['sector_ids']))?'selected':''?>><?=$sector['sector_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>

                            <label for="other_sector" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_sector']) && !empty($study['other_sector']))?'visible':'hidden1' ?>">6(a). Please specify the other thematic area(s) which the study covers:</label>
                            <textarea name="other_sector" required="required" id="other_sector" placeholder="(list other thematic area(s) separated by commas)" class="form-control <?=(isset($study['other_sector']) && !empty($study['other_sector'])) ? 'visible':'hidden1' ?> font-12"><?=$study['other_sector']?></textarea>
                        </div>
                    </div>
                    <hr>
                </div>


                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="objectives" class="weight-400 font-13">7. Please provide the objective(s) of the study: (*)</label>
                            <textarea  placeholder="(state the key questions to be addressed e.g. Identify the QoL outcomes of loans from AKAM for repeat clients; Evaluate the outcomes from a chronic disease intervention programme)" required="required" rows="6" id="objectives" name="objectives" class="form-control font-12"><?=$study['objectives']?></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label for="tools[]" class="weight-400 font-13">8. Please provide the main methods and tools to be used in the study: (*)</label>
                            <select multiple required="required" name="tools[]" id="tools" class="form-control selectpicker" title="(select all that apply)">
                                <?php if (isset($methods) && $methods != false): ?>
                                    <?php foreach ($methods as $method):?>
                                        <option value="<?=$method['id']?>" <?=(in_array($method['id'],$study['tools_ids']))?'selected':''?>><?=$method['method_name']?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>

                            <label for="other_tools" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_tools']) && !empty($study['other_tools']))?'visible':'hidden1'?>">8(a). Please specify other methods and tools to be used in the study:</label>
                            <textarea name="other_tools" id="other_tools" placeholder="(list other methods and tools separated by commas)" class="form-control <?=(isset($study['other_tools']) && !empty($study['other_tools']))?'visible':'hidden1'?> font-12"><?=$study['other_tools']?></textarea>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="collaboration_radio" class="weight-400 font-13">9. Is the study conducted in collaboration with other AKDN or external agency(ies)? (*)</label>
                            <!-- <div class="checkbox">
                                <label>
                                    <?php if(isset($study['collaborators_ids'][1]) && count($study['collaborators_ids'][1]) > 0) :?>
                                        <input type="checkbox" name="collaboration_radio" checked="checked" id="collaboration_radio">
                                    <?php else : ?>
                                        <input type="checkbox" name="collaboration_radio" id="collaboration_radio">
                                    <?php endif;?>
                                    Other Agencies Collaborating?
                                </label>
                            </div> -->
                            <select multiple required="required" name="collaboration_radio[]" id="collaboration_radio" class="form-control selectpicker" title="(select all that apply)">
                                <option value="0" <?=(isset($study['collaboration_type_id']) && in_array('0', $study['collaboration_type_id']))?'selected':''?>>None</option>
                                <option value="1" <?=(isset($study['collaboration_type_id']) && in_array('1', $study['collaboration_type_id']))?'selected':''?>>AKDN agency</option>
                                <option value="2" <?=(isset($study['collaboration_type_id']) && in_array('2', $study['collaboration_type_id']))?'selected':''?>>External agency</option>
                            </select>
                            
                            <label for="collaborators" class="margin-top-30 weight-400 font-13">9(a). Please select all the AKDN agencies you are collaborating with in this study:</label>
                            <select multiple name="collaborators[]" id="collaborators" class="selectpicker form-control" title="(select all that apply)">
                                <?php if (isset($agencies) && $agencies != false): ?>
                                     <!-- <?php //print_r($study['collaborators_ids']); ?>  -->
                                    <?php foreach ($agencies as $agency):?>
                                        <?php if(isset($study['collaborators_ids'][0]) && $study['collaborators_ids'][0] == 'id'): ?>
                                           <option value="<?=$agency['id']?>" <?=(isset($study['collaborators_ids'][1]) && in_array($agency['id'],$study['collaborators_ids'][1]))?'selected':''?> <?=set_select('collaborators', $agency['id'])?>><?=$agency['agency_name']?></option>
                                         <?php else: ?>
                                           <option value="<?=$agency['id']?>" <?=(isset($study['collaborators_ids']) && in_array($agency['id'],$study['collaborators_ids'] ))?'selected':''?> <?=set_select('collaborators', $agency['id'])?>><?=$agency['agency_name']?></option>
                                         <?php endif; ?>  
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="other_collaborators" class="weight-400 font-13">9(b). Please specify the other external agencies you are collaborating with in this study:</label>
                            <input type="text" value="<?=$study['other_collaborators']?>" name="other_collaborators" id="other_collaborators" placeholder="(specify the other external agencies you are collaborating with if known)" class="form-control font-12"/>
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
                                        <option value="<?=$start['id']?>"<?=($start['id'] == $study['start_date_id'])?'selected':''?>><?=$start['start_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            <span class="text-danger weight-400 font-13" id="js_error_startdate"></span>

                            <label for="other_start_date" class="weight-400 margin-top-30 font-13 <?=(isset($study['start_date_id']) && ($study['start_date_id'] =='10'))?'visible':'hidden1' ?>">10(a). Please specify the other start date of the study:</label>
                            <input type="text" value="<?=$study['start_date']?>" name="other_start_date" id="other_start_date" placeholder="(specify the other start date as a quarter if known e.g. Q3-2015)" class="form-control <?=(isset($study['start_date_id']) && ($study['start_date_id'] =='10'))?'visible':'hidden1' ?> font-12"/>
                        </div>
                        <div class="col-sm-6">
                            <label for="end_date" class="weight-400 font-13">11. Please select the study end date: (*)</label>
                            <select  required="required" name="end_date" id="end_date" class="form-control selectpicker" title="(when did/does the study end? e.g. Q1-2017)">
                                <?php if (isset($ends) && $ends != false): ?>
                                    <?php foreach ($ends as $end):?>
                                    <option value="<?=$end['id']?>"<?=($end['end_name'] == $study['end_date'])?'selected':''?>><?=$end['end_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>
                            <span class="text-danger js_error_enddate font-12 weight-400 font-13"></span>

                            <label for="other_end_date" class="weight-400 margin-top-30 font-13 <?=(isset($study['end_date_id']) && ($study['end_date_id'] =='10'))?'visible':'hidden1' ?>">11(a). Please specify the other end date of the study:</label>
                            <input type="text" value="<?=$study['end_date']?>" name="other_end_date" id="other_end_date" placeholder="(specify the other end date as a quarter if known e.g. Q2-2018)" class="form-control <?=(isset($study['end_date_id']) && ($study['end_date_id'] =='10'))?'visible':'hidden1' ?> font-12"/>
                        </div>
                    </div>
                </div>
            </fieldset>


            <fieldset class="bg-white shadow margin-top-20">
                <div class="h3 text-left bg-white padding-bottom-10 margin-left-30">Funding and Human Resources</div>
                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <label for="budget" class="weight-400 font-13">12. Please provide the currency code for study budget: </label>
                            <select  name="budget" id="budget" class="form-control selectpicker"  title="(select the budget currency e.g. USD)">
                                <?php if (isset($currencies) && $currencies != false): ?>
                                    <option value="" selected='selected' >None</option>
                                    <?php foreach ($currencies as $currency):?>
                                        <option value="<?=$currency['id']?>" <?=($currency['id'] == $study['currency_id'])?'selected':''?> ><?=$currency['currency_name']?></option>
                                    <?php endforeach;?>
                                <?php endif?>
                            </select>

                            <label for="other_currency" class="weight-400 margin-top-30 font-13 <?=(isset($study['currency_id']) && ($study['currency_id'] == '6'))?'visible':'hidden1' ?>">12(a). Please specify the other currency for study budget:</label>
                            <input type="text" value="<?=(isset($study['currency_id']) && ($study['currency_id'] == '6'))?$study['currency_code']:'' ?>" id="other_currency" name="other_currency" placeholder="(specify the other budget currency e.g. Indian Rupees)" class="form-control <?=(isset($study['currency_id']) && ($study['currency_id'] == '6'))?'visible':'hidden1' ?> font-12"/>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="amount" class="weight-400 font-13">13. Please provide the total budget amount for the study: </label>
                            <input type="text" name="amount" value="<?=$study['amount'];?>" class="form-control font-12" id="amount" placeholder="(Please provide the entire total budget for the study e.g. 10000)"/>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="amount_2016" class="weight-400 margin-top-30 font-13">13(a). Please provide the total budget amount for 2016 (if possible):</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" name="amount_2016" value="<?= $study['amount_2016'];?>" class="form-control font-12" id="amount_2016" placeholder="(Please provide budget allocation for 2016 for the study e.g. 5000)"/>
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
                            <select multiple required="required" name="fund_source[]" id="fund_source" class="form-control selectpicker"  title="(select all that apply)">
                                <option value="1" <?=(in_array('1', $study['fund_source_id']))?'selected':''?>>Internal to your agency</option>
								<option value="3" <?=(in_array('3', $study['fund_source_id']))?'selected':''?>>Another AKDN agency</option>
                                <option value="2" <?=(in_array('2', $study['fund_source_id']))?'selected':''?>>External funding</option>
                            </select>
                                
                            <label for="other_fund" class="weight-400 margin-top-30 font-13 <?=(isset($study['other_fund']) && !empty($study['other_fund']))?'visible':'hidden1' ?>">14(a). Please specify the external funding source/name:</label>
                            <textarea name="other_fund" class="form-control <?=(isset($study['other_fund']) && !empty($study['other_fund']))?'visible':'hidden1' ?> font-12" id="other_fund" placeholder="(specify the source of external funding e.g. USAID, DFID)"><?=$study['other_fund'];?></textarea>
                        </div>
                        
                        <div class="col-sm-6">
                            <label for="human_resource[]" class="weight-400 font-13">15. Please select the human resources involved in this study: (*)</label>
                            <select multiple required="required" name="human_resource[]" id="human_resource" class="form-control selectpicker" title="(select all that apply)">
                                <option value="1" <?=(in_array('1',$study['human_resource_id']))?'selected':''?>>Internal to your agency</option>
								<option value="3" <?=(in_array('3',$study['human_resource_id']))?'selected':''?>>Another AKDN agency</option>
                                <option value="2" <?=(in_array('2',$study['human_resource_id']))?'selected':''?>>External to your agency</option>
                            </select>

                            <!-- <label for="other_hr" class="weight-400 margin-top-30 font-13 <?php// echo(isset($study['other_hr']) && !empty($study['other_hr']))?'visible':'hidden1' ?>">16. Please specify the external human resources:</label>
                            <textarea name="other_hr" class="form-control <?php// echo(isset($study['other_hr']) && !empty($study['other_hr']))?'visible':'hidden1' ?>" id="other_hr" placeholder="Other Human Resources"><?php// echo$study['other_hr'];?></textarea> -->
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="form-group padding-left-20 padding-right-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="contact_name" class="weight-400 font-13">16. Please provide the name of key contact for this study: (*)</label>
                            <input  required="required" type="text" value="<?=$study['contact_name']?>" class="form-control font-12" id="contact_name" name="contact_name" placeholder="(provide the name(s) of the study's key contact)">
                        </div>
                        <div class="col-sm-6">
                            <label for="contact_email" class="weight-400 font-13">17. Please provide the email of key contact for this study: (*)</label>
                            <input required="required" type="email" class="form-control font-12" value="<?=$study['contact_email']?>" id="contact_email" name="contact_email" placeholder="(provide the email address of the study's key contact)">
                        </div>
                    </div>
                </div>

                <div class="form-group padding-left-20 padding-right-20 margin-bottom-20">
                    <div class="row">
                        <div class=" col-sm-2">
                            <button type="button" id="saveStudy" class="btn btn-block btn-info">Save Study Partially</button>
                        </div>
                        <div class=" col-sm-2">
                            <input type="hidden" name="editStudy" value="Save Study" >
                            <input type="submit" id="addStudy" value="Submit Study" class="btn btn-block btn-primary"/>
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
var get_sector = "<?=site_url('dashboard/getThemesFromStudies/'.$study['id']);?>";
</script>
<?php $this->load->view('dashboard/footer');?>
