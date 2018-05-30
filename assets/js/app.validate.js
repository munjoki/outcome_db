// This file contains the validations for the front end applicatiion
var val = $('#addStudyForm').validate({
    rules: {
        title               : {required: true,minlength: 3},
        "country[]"         : {required:true},
        other_country       : {required:true},
        other_status        : {required:true},
        sub_location        : {minlength: 3},
        "sector[]"          : {required: true},
        other_sector        : {required: true, minlength:3},
        //"theme[]"           : {required: true},
        //other_theme         : {required: true, minlength:3},
        objectives          : {required: true, minlength:3},
        "tools[]"           : {required: true},
        other_tools         : {required: true, minlength:3},
        "collaborators[]"   : {required: true},
        study_status        : {required: true},
        // budget              : {required: true},
        other_currency      : {required: true, minlength:3},
        amount              : {digits : true},
        "fund_source[]"     : {required: true},
        other_fund          : {required: true, minlength:3},
        "human_resource[]"  : {required: true},
        other_collaborators : {required: true, minlength:3},
        start_date          : {required:true},
        other_start_date    : {required:true},
        other_end_date      : {required:true},
        end_date            : {required:true},
        contact_name        : {required:true, minlength:3},
        contact_email       : {required:true, email:true},
        description         : {minlength:3},
        "collaboration_radio" : {required:true},
        amount_2016         : {digits:true}       
    },
    // dates{
    //     {start_date,end_date}
    // },
    messages: {
        title: {
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide the Study Title.</div>",
            minlength   :   "<div class='weight-400 font-12 text-danger'>Study Title should have at least 3 characters.</div>"
        },
        "country[]": {
            required    :   "<div class='weight-400 font-12 text-danger'>Please select at least one Country.</div>"
        },
        "collaboration_radio": {
            required    :   "<div class='weight-400 font-12 text-danger'>Please select at least one Collaboration Options.</div>"
        },
        other_country: {
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide name of other country(ies) .</div>"
        },
        other_status: {
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide Other Study Status.</div>"
        },
        sub_location: {
            minlength   :   "<div class='weight-400 font-12 text-danger'>Sub National Location should have at least 3 characters.</div>"
        },
        "sector[]": {
            required    :   "<div class='weight-400 margin-bottom-10 font-12 text-danger'>Please select a Sector.</div>"
        },
        other_sector: {
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide Other Sectors.</div>",
            minlength   :   "<div class='weight-400 font-12 text-danger'>Other Sectors should have at least 3 characters.</div>"
        },
        //"theme[]": {
          //  required    :   "<div class='weight-400 font-12 text-danger'>Please select a Themes.</div>"
	//},
        //other_theme: {
         //   required    :   "<div class='weight-400 font-12 text-danger'>Please provide Other Themes.</div>",
         //   minlength   :   "<div class='weight-400 font-12 text-danger'>Other Themes field should have at least 3 characters.</div>"
//},
        objectives: {
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide Study Objectives.</div>",
            minlength   :   "<div class='weight-400 font-12 text-danger'>Study Objectives should have at least 3 characters.</div>"
        },
        "tools[]": {
            required    :   "<div class='weight-400 font-12 text-danger'>Please select Method And Tools.</div>"
        },
        other_tools: {
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide Other Methods and Tools.</div>",
            minlength   :   "<div class='weight-400 font-12 text-danger'>Other Methods and Tools should have at least 3 characters.</div>"
        },
        "collaborators[]" :{
            required    :   "<div class='weight-400 font-12 text-danger'>Please select Other Collaborating Agencies.</div>"
        },
        study_status :{
            required    :   "<div class='weight-400 font-12 text-danger'>Please select Study Status</div>"
        },
        // budget :{
        //     required    :   "<div class='weight-400 font-12 text-danger'>Please select Currency</div>"
        // },
        other_currency :{
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide Other Currency</div>",
            minlength   :   "<div class='weight-400 font-12 text-danger'>Other Currency should have at least 3 characters.</div>"
        },
        amount :{
            // required    :   "<div class='weight-400 font-12 text-danger'>Please provide Total Budget</div>",
            digits     :   "<div class='weight-400 font-12 text-danger'>Total Budget should be a number eg 10000 </div>"
        },
        amount_2016 :{
            // required    :   "<div class='weight-400 font-12 text-danger'>Please provide the Budget for 2016</div>",
            digits     :   "<div class='weight-400 font-12 text-danger'>Budget for 2016 should be a number eg 10000 </div>"
        },
        "fund_source[]":{
            required    :   "<div class='weight-400 font-12 text-danger'>Please select Funding Source</div>"
        },
        other_fund :{
            required    :   "<div class='weight-400 font-12 text-danger'>Please specify external funding source used.</div>",
            minlength     :   "<div class='weight-400 font-12 text-danger'>The external funding source used should have at least 3 characters </div>"
        },
        "human_resource[]":{
            required    :   "<div class='weight-400 font-12 text-danger'>Please select Human Resources</div>"
        },
        other_collaborators :{
            required    :   "<div class='weight-400 font-12 text-danger'>Please specify External Collaborating Agencies.</div>",
            minlength     :   "<div class='weight-400 font-12 text-danger'>External Collaborating Agencies used should have at least 3 characters </div>"
        },
        start_date:{
            required    :   "<div class='weight-400 font-12 text-danger'>Please select Start Date</div>"
        },
        end_date:{
            required    :   "<div class='weight-400 font-12 text-danger'>Please select End Date</div>"
        },
        other_start_date: {
            required    :   "<div class='weight-400 font-12 text-danger'>Please select Other Start Date</div>"
        },
        other_end_date  : {
            required    :   "<div class='weight-400 font-12 text-danger'>Please select Other End Date</div>"
        },
        contact_name :{
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide the Contact Name</div>",
            minlength   :   "<div class='weight-400 font-12 text-danger'>Contact Name should have at least 3 characters </div>"
        },
        contact_email :{
            required    :   "<div class='weight-400 font-12 text-danger'>Please provide Contact Email Address</div>",
            email       :   "<div class='weight-400 font-12 text-danger'>Invalid Email address format </div>"
        },
        description : {
            minlength   :   "<div class='weight-400 font-12 text-danger'>Additional Details should have minimum 3 characters</div>"
        }
    }
    // errorElement: "span"
});

$("#search_button").click(function(e){
    e.preventDefault();
    search_item = $("#search_item").val().trim();
    if(search_item == "" || search_item == undefined){
        $("#search_error").empty();
        $("#search_error").text("Please provide a search item");
        return false;
    }
    if(search_item.length <3){
        $("#search_error").empty();
        $("#search_error").text("Please provide at least 3 characters to search");
        return false;
    }

    $("#search_form").submit();
});


$("#addStudy").click(function(e){
    e.preventDefault();
    // $('#addStudyForm').submit();
    // val.validate();
    var validator = $( "#addStudyForm" ).validate();
    validator.form();

    end_date = $("#end_date").val();
    start_date = $("#start_date").val();

    flag = true;

    if(end_date < start_date){
        flag = false;
        $("#js_error_startdate").empty();
        $("#js_error_startdate").html("<span>Start date cannot be greater than end date</span><br/>");
        // console.log("error here date",start_date,end_date);
    }
    
    if(start_date == 10 && end_date > 0) {
        flag = true;
        $("#js_error_startdate").empty();
    }
    
    if(validator.numberOfInvalids() > 0){
        console.log(validator.numberOfInvalids());
        flag = false;
    }
    
    
    // console.log("value of flag",flag);
    if(flag === true){
        $( "#addStudyForm" ).submit();
    }
    else{
        alert("Some fields have been left blank or contain error(s).\nPlease review the information provided and re-submit");
        $('#theme').selectpicker('refresh');
        return false;
    }
});

var validation_password = $("#change_password_form").validate({
    rules : {
        password : {required : true},
        confirm_password : {required : true, equalTo : "#password"}
    },
    messages : {
        password : {
            required : "<div class='weight-400 font-12 text-danger'>Please provide the password</div>"
        },
        confirm_password : {
            required : "<div class='weight-400 font-12 text-danger'>Please provide the confirmation password</div>",
            equalTo : "<div class='weight-400 font-12 text-danger'>The Confirmed Password field does not match the Password field.</div>"
        }
    }
});