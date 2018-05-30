jQuery(document).ready(function($) {
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: 10,
        liveSearch: true,
    });
    $(".hidden1").attr("disabled", true);
    $("select.selectpicker").on("changed.bs.select", function() {
        text = $(this).find("option:selected").text().trim();
        if (text.contains('Other') != false || text.contains('External') != false) {
            hidden = $(this).parent().parent().find(".hidden1");
            // console.log(hidden);
            $.each(hidden, function(index, el) {
                $(el).removeClass('hidden');
                $(el).addClass('visible');
                $(el).attr('disabled', false);
            });
        } else {
            visible = $(this).parent().parent().find(".visible");
            console.log(visible);
            $.each(visible, function(index, el) {
                if ($(el).hasClass('form-control')) {
                    $(el).val("");
                    $(el).text("");
                    // console.log($(el));
                }
                $(el).removeClass('visible');
                $(el).addClass('hidden1');
                $(el).attr('disabled', true);
            });
        }

        // text2 = $("#end_date").val();
        // text3 = $("#start_date").val();
        // console.log(text3);
        // console.log(text2);

        // if(text3 == undefined || text3 == null || text3 == ""){
        //     $(".js_error_enddate").empty();
        //     $(".js_error_enddate").html("<span>Please provide all the dates</span><br>");
        // }
        // else if(text3>text2){
        //     $(".js_error_enddate").empty();
        //     $(".js_error_enddate").html("<span>Start date cannot be greater than end date</span><br>");
        // }
        // else{
        //     $(".js_error_enddate").empty();
        // }
    });
    $('#example').DataTable({
        "searching": false,
        "columnDefs": [{
            "orderable": false,
            "targets": [8, 9, 10]
        }],
    });
    // count = 0;
    // $.each($(".btn-sm-td-center"), function(k, v) {
    //     // var height = 0;
    //     // if ((count) % 3 == 0) {
    //     //     height = $(v).parent().height();
    //     //     console.log($(v).parent());
    //     // }
    //     // count++;
    //     // $(v).height(50);
    // });
    $(".view-page").click(function() {
        window.document.location = $(this).parent().attr('id');
    });
    $("#collaborators").prop('disabled', 'disabled');
    $("#collaboration_radio").click(function() {
        if ($("#collaboration_radio").is(":checked")) {
            $("#collaborators").prop('disabled', false);
        } else {
            $("#collaborators").prop('disabled', 'disabled');
        }
    });
    if ($("#collaboration_radio").is(":checked")) {
        $("#collaborators").prop('disabled', false);
    } else {
        $("#collaborators").prop('disabled', 'disabled');
    }
    // populate the themes dropdown values
    $("#sector").change(function() {
        data = [];
        // console.log($("option:selected").val());
        // console.log($(this).attr('selected'));
        $.each($(this), function(index, val) {
            // console.log($(val).text());
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

    var get_sector_exists = (typeof get_sector !== typeof undefined ? true : false);
    console.log(get_sector_exists);
    // if (get_sector_exists || null == data ) {
    //     $('#theme').selectpicker('refresh');
    // } 
    // else 
        if (data.length > 0) {
        $('#theme').selectpicker('refresh');
        var return_first = function() {
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
        console.log(return_first);
        createThemeFromOptions(data, return_first);
    }
    $(".delete").click(function() {
        var r = confirm("Are you sure you want to delete this study?");
        if (r == true) {
            txt = "You pressed OK!";
        } else {
            return false;
        }
    });
});
$(".hide").hide();

function createThemeFromOptions(data, return_first) {
    // if (data.length > 0) {
    if (data == null || data == undefined) {
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
        if (a.length > 0) {
            theme = $("#theme");
            theme.empty();
            $.each(a, function(index, el) {
                template = "<option value='__value__' >__text__</option>";
                data = template.replace(/__value__/g, el.theme_id);
                data = data.replace(/__text__/g, el.theme_name);
                for (var i = return_first.length - 1; i >= 0; i--) {
                    if (return_first[i] == el.theme_id) {
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
    // };
}

function createThemeOption(data) {
    if (data == null || data == undefined) {
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
    // };



}