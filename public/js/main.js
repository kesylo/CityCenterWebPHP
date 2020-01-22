$(document).ready(function(){
    document.cookie = "waiting" + "=" + "all";
});

function cbSubmit() {
    document.getElementById("cbForm").submit();
}

$('input[name="radioWaiting"]').change(function(){
    if($('#radiowaiting1').prop('checked')){
        document.cookie = "waiting" + "=" + "all";
        reload();
    }
    if($('#radiowaiting2').prop('checked')){
        document.cookie = "waiting" + "=" + "waiting";
        reload();
    }
});






$(function () {

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

    $('#dateWeekDash').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
    });

    $('#dateWeekDash').on("change.datetimepicker", function (e) {
        strDate = moment(e.date).format('DD-MM-YYYY');

        createCookieDate(strDate);
        reload();
    });


});





$(function () {

    $('#dateWeek').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
    });
    $('#dateDisp').datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false,
    });

    $("#dateWeek").on("change.datetimepicker", function (e) {
        $('#dateDisp').datetimepicker('minDate', e.date);
    });



    /* For bulk add */
    $('#dateWeekBulk').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
    });
    $('#dateDispBulk').datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false,
    });
    $("#dateWeekBulk").on("change.datetimepicker", function (e) {
        $('#dateDispBulk').datetimepicker('minDate', e.date,);
        $('#dateDispBulk').datetimepicker('date', moment(e.date, 'DD-MM-YYYY'));
    });

});



function createCookieDate(strDate) {
    document.cookie = "nextWeekDate" + "=" + strDate;
}

function reload(){
    $( "#card-reload" ).load( " #card-reload" );
}

function getNextWeekDate(){
    let d = new Date();
    d.setDate(d.getDate() + (1 + 7 - d.getDay()) % 7);


    let dd = d.getDate();
    let mm = d.getMonth() + 1;

    let yyyy = d.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    let today = dd + '-' + mm + '-' + yyyy;

    return today;
}

$(window).bind('beforeunload',function(){
    createCookieDate(getNextWeekDate());

});
