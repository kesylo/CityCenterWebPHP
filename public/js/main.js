
$(document).ready(function() { // init all fields here

    //region App Globals

    createCookie("previewDate", nextWeekdayDate(1), 10);
    createCookie("filter", "all", 10);
    createCookie("edit_on_admin", true, 10);

    //endregion

    //region Add

    $('#dateWeekAdd').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
        date: moment().add(1, 'weeks').startOf('isoWeek'),
    });

    $('#dateDayAvailableAdd').datetimepicker({
        format: 'DD-MM-YYYY',
        minDate: moment().add(1, 'weeks').startOf('isoWeek'),
    });

    $("#dateWeekAdd").on("change.datetimepicker", function (e) {
        $('#dateDayAvailableAdd').datetimepicker('minDate', e.date);
    });

    $('#timeStart').datetimepicker({
        format: 'HH:mm',
        stepping: 25,
        forceMinuteStep: true,
    });

    $('#timeEnd').datetimepicker({
        format: 'HH:mm',
        stepping: 25,
        forceMinuteStep: true,
    });

    //endregion

    //region AddExtra

    $('#dateWeekAddExtra').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
        date: moment().add(1, 'weeks').startOf('isoWeek'),
    });

    $('#dateDayAvailableAddExtra').datetimepicker({
        format: 'DD-MM-YYYY',
        minDate: moment().add(1, 'weeks').startOf('isoWeek'),
    });

    $("#dateWeekAddExtra").on("change.datetimepicker", function (e) {
        $('#dateDayAvailableAddExtra').datetimepicker('minDate', e.date);
    });

    //endregion

    //region DashBoard
    $('#dateWeekDash').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
        date: moment().add(1, 'weeks').startOf('isoWeek'),
    });

    $('#dateWeekDash').on("change.datetimepicker", function (e) {
        createCookie("previewDate", moment(e.date).format('DD-MM-YYYY'), 10);
        reload();
    });
    //endregion

    //region DashBoard Admin

    $('#dateWeekDashAdmin').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
        date: moment().add(1, 'weeks').startOf('isoWeek'),
    });

    $('#dateWeekDashAdmin').on("change.datetimepicker", function (e) {
        createCookie("previewDate", moment(e.date).format('DD-MM-YYYY'), 10);
        reload();
    });

    $('input[name="radioWaiting"]').change(function(){

        if($('#radiowaiting1').prop('checked')){
            createCookie("filter", "all", 10);
            reload();
        }

        if($('#radiowaiting2').prop('checked')){
            createCookie("filter", "waiting", 10);
            reload();
        }
    });

    //endregion

});



function nextWeekdayDate(day_in_week) {
    let date = new Date();
    let ret = new Date(date||new Date());
    let momentJSDate = ret.setDate(ret.getDate() + (day_in_week - 1 - ret.getDay() + 7) % 7 + 1);
    let stringDate = moment(momentJSDate).format('DD-MM-YYYY');
    return stringDate;
}

function reload(){
    $( "#card-reload" ).load( " #card-reload" );
}

$(window).bind('beforeunload',function(){
    createCookieDate(getNextWeekDate());

});

// Function to create the cookie
function createCookie(name, value, days) {
    var expires;

    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
}

