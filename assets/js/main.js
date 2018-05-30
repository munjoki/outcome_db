jQuery(document).ready(function ($) {
    // styling the select dropdowns
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: 10,
        liveSearch: true,
    });

    // hidden atributes
    $(".hidden1").attr("disabled", true);
    $(".hidden1").val("");

    // trigger an event on change of the select options
    $("select.selectpicker").on("changed.bs.select", function () {
        text = $(this).find("option:selected").text().trim();
        if (text.indexOf('Other') != -1 || text.indexOf('External') != -1)
        {
            hidden = $(this).parent().parent().find(".hidden1");
            $.each(hidden, function (index, el) {
                $(el).removeClass('hidden1');
                $(el).addClass('visible');
                $(el).attr('disabled', false);
            });
        } else
        {
            visible = $(this).parent().parent().find(".visible");
            $.each(visible, function (index, el) {
                if ($(el).hasClass('form-control')) {
                    $(el).val("");
                    $(el).text("");
                }
                $(el).removeClass('visible');
                $(el).addClass('hidden1');
                $(el).attr('disabled', true);
            });
        }
    });

    // styling for the tables
    if($( "#example" ).length){
        $('#example').dataTable({
            "searching": false,
            "columnDefs": [{
                    "orderable": false,
                    //"targets": [8, 9, 10]
                }],
        });
    }
    
    
    $(".view-page").click(function () {
        window.document.location = $(this).parent().attr('id');
    });

    // collaboration validation in the study form
    $("#collaborators").prop('disabled', 'disabled');
    $("#collaboration_radio").change(function ()
    {
        agency_vals = $(this).val();
        if (agency_vals == null || agency_vals == undefined || agency_vals.indexOf("0") !== -1)
        {
            $("#collaborators").prop('disabled', 'disabled');
            $("#other_collaborators").prop('disabled', 'disabled');
            $('#collaborators').selectpicker('deselectAll');
        } else
        {
            if (agency_vals.indexOf("1") !== -1)
            {
                $("#collaborators").prop('disabled', false);
            } else
            {
                $("#collaborators").prop('disabled', 'disabled');
                $('#collaborators').selectpicker('deselectAll');
            }
            if (agency_vals.indexOf("2") !== -1)
            {
                $("#other_collaborators").prop('disabled', false);
            } else
            {
                $("#other_collaborators").prop('disabled', 'disabled');
                $('#other_collaborators').selectpicker('deselectAll');
            }
        }
    });

    // agency validation
    agency_vals = $("#collaboration_radio").val();

    if (agency_vals == null || agency_vals == undefined || agency_vals.indexOf("0") !== -1)
    {
        $("#collaborators").prop('disabled', 'disabled');
        $('#collaborators').selectpicker('deselectAll');
        $("#other_collaborators").prop('disabled', 'disabled');
    } 
    else
    {
        if (agency_vals.indexOf("1") !== -1)
        {
            $("#collaborators").prop('disabled', false);
        } else
        {
            $("#collaborators").prop('disabled', 'disabled');
            $('#collaborators').selectpicker('deselectAll');
        }
        if (agency_vals.indexOf("2") !== -1)
        {
            $("#other_collaborators").prop('disabled', false);
        } else
        {
            $("#other_collaborators").prop('disabled', 'disabled');
            $('#other_collaborators').selectpicker('deselectAll');
        }
    }

    $("#amount_2016").prop('disabled', 'disabled');
    $("#start_date").change(function ()
    {
        validateDates();
    })
    $("#end_date").change(function ()
    {
        validateDates();
    });

    if ($("#start_date").val() != "" || $("#start_date").val() != undefined)
    {
        validateDates();
    }


    // populate the themes dropdown values
    /*$("#sector").change(function() 
     {
     data = [];
     $.each($(this), function(index, val) {
     data = $(val).val();
     });
     // if (null == data) {} else if (data.length > 0) {
     createThemeOption(data);
     // }
     });
     data = [];
     $.each($("#sector option:selected"), function(index, val) {
     data.push($(val).val());
     });
     */
    /* 
     var get_sector_exists = (typeof get_sector !== typeof undefined ? true : false);
     if (get_sector_exists || null == data ) {
     $('#theme').selectpicker('refresh');
     } 
     else 
     if (data.length > 0) 
     {
     $('#theme').selectpicker('refresh');
     var return_first = function() 
     {
     var tmp = null;
     $.ajax({
     'async': false,
     'type': "GET",
     'global': false,
     'dataType': 'json',
     'url': get_sector,
     'data': {},
     'success': function(data) {
     tmp = data;
     }
     });
     return tmp;
     }();
     createThemeFromOptions(data, return_first);
     }
     */

    // when the study is being deleted
    $(".delete").click(function ()
    {
        var r = confirm("Are you sure you want to delete this study?");
        if (r == true)
        {
            txt = "You pressed OK!";
        } else
        {
            return false;
        }
    });

    // when the partial study is saved
    $("#saveStudy").click(function ()
    {
        if ($("#title").val().trim() == "")
        {
            alert("You must at least provide the Study Title to save the form");
            return false;
        }
        var r = confirm("This form is partially filled. Please click on OK to save the form");
        if (r == false)
        {
            return false;
        } else
        {
            form = new FormData(document.getElementById("addStudyForm"));
            $.ajax({
                url: site_url + "/ajaxprocessor/saveMessage/",
                type: 'POST',
                dataType: 'json',
                data: form,
                cache: false,
                contentType: false,
                processData: false
            }).done(function (a) {
                console.log(a);
                if (a.message == "success" && a.messageCode == "102") {
                    window.document.location = a.url;
                }
                console.log("success");
            }).fail(function () {
                console.log("error");
            }).always(function () {
                console.log("complete");
            });
        }
    });

    // allow to enter the budget only when currency code (budget) is not "None"
    $("#amount").prop('disabled', 'disabled');
    $("#amount_2016").prop('disabled', 'disabled');

    $("#budget").change(function () {
        var budget_val = $(this).val().trim();
        if (budget_val == "") {
            $("#amount").val('0');
            $("#amount_2016").val('0');
            $("#amount").prop('disabled', 'disabled');
            $("#amount_2016").prop('disabled', 'disabled');
        } else {
            $("#amount").prop('disabled', false);
            $("#amount_2016").prop('disabled', false);
        }
    });

    if ($("#budget").val() == "" || validateDates == false) {
        $("#amount").prop('disabled', 'disabled');
        $("#amount_2016").prop('disabled', 'disabled');
    } else {
        $("#amount").prop('disabled', false);
        $("#amount_2016").prop('disabled', false);
    }


});
$(".hide").hide();

/*
 function createThemeFromOptions(data, return_first) 
 {
 // if (data.length > 0) {
 if (data == null || data == undefined) 
 {
 $("#theme").empty();
 }
 $('#theme').selectpicker('refresh');
 $.ajax({
 url: site_url + '/dashboard/getThemes',
 type: 'POST',
 dataType: 'json',
 data: {
 param1: data
 },
 }).done(function(a) {
 if (a.length > 0) 
 {
 theme = $("#theme");
 theme.empty();
 $.each(a, function(index, el) {
 template = "<option value='__value__' >__text__</option>";
 data = template.replace(/__value__/g, el.theme_id);
 data = data.replace(/__text__/g, el.theme_name);
 for (var i = return_first.length - 1; i >= 0; i--) 
 {
 if (return_first[i] == el.theme_id) 
 {
 data = data.replace(/<option/g, "<option selected");
 }
 };
 theme.append(data);
 });
 $('#theme').selectpicker('refresh');
 }
 }).fail(function(a) {
 console.log("error");
 });
 }
 */
/*
 function createThemeOption(data) 
 {
 if (data == null || data == undefined) 
 {
 $("#theme").empty();
 }
 $('#theme').selectpicker('refresh');
 // if (data.length > 0) {
 $.ajax({
 url: site_url + '/dashboard/getThemes',
 type: 'POST',
 dataType: 'json',
 data: {
 param1: data
 },
 }).done(function(a) {
 if (a.length > 0) {
 theme = $("#theme");
 theme.empty();
 $.each(a, function(index, el) {
 template = "<option value='__value__'>__text__</option>";
 data = template.replace(/__value__/g, el.theme_id);
 data = data.replace(/__text__/g, el.theme_name);
 theme.append(data);
 });
 $('#theme').selectpicker('refresh');
 }
 }).fail(function(a) {
 console.log(a);
 console.log("error");
 });
 };
 */




/**
 * DESCRIPTION
 * If study starts on Q4-2015, and ends in Q1,2,3,4 2016; ask the 2016 budget
 * If study starts on Q4-2015, and ends in Q1,2,3,4 2017,Q1-2018; then ask 2016 budget
 * If study starts on Q1,2,3,4-2016, and ends in Q2,3,4 2017,Q1-2018 then ask 2016 budget
 * If the study starts in Q1-2017 onwards; do not ask 2016 budget
 * @returns {Boolean}
 */
function validateDates()
{
    // before anything just check if the currency code (budget) is not blank (or None)
    if ($("#budget").val() == "") {
        $("#amount_2016").val('0');
        $("#amount_2016").prop('disabled', 'disabled');
        return false;
    }

    end_date = parseInt($("#end_date").val());
    start_date = parseInt($("#start_date").val());

    // console.log(start_date == 1 && end_date < 9);
    // If study starts on Q4-2015, and ends in Q1,2,3,4 2016; ask the 2016 budget
    // If study starts on Q4-2015, and ends in Q1,2,3,4 2017,Q1-2018 then ask 2016 budget
    if (start_date == 1 && end_date < 10)
    {
        $("#amount_2016").prop('disabled', false);
        // console.log($("#amount_2016").prop('disabled'));
    }
    // If study starts on Q1,2,3,4-2016, and ends in Q1,2,3,4 2017,Q1-2018 then ask 2016 budget
    else if ((start_date > 1 && start_date < 6) && (end_date > 5 && end_date < 10))
    {
        $("#amount_2016").prop('disabled', false);
        // console.log($("#amount_2016").prop('disabled'));
    }
    // If the study starts in Q1-2017 onwards; do not ask 2016 budget
    else if (start_date > 5)
    {
        $("#amount_2016").prop('disabled', 'disabled');
        return false;
    } else
    {
        $("#amount_2016").prop('disabled', 'disabled');
        return false;
    }



}