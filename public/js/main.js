
$(function () {
    $('#dateWeek').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
    });

    $('#timeStart').datetimepicker({
        format: 'HH:mm',

    });

    $('#timeEnd').datetimepicker({
        format: 'HH:mm',
    });

    $('#dateDisp').datetimepicker({
        format: 'DD-MM-YYYY',
        useCurrent: false,
        defaultDate: new Date(),
    });

    $('#dateWeekDash').datetimepicker({
        format: 'DD-MM-YYYY',
        daysOfWeekDisabled:[0,2,3,4,5,6],
    });


    $('#dateWeekDash').on("change.datetimepicker", function (e) {
        strDate = moment(e.date).format('DD-MM-YYYY');

        console.log(strDate);
        createCookie(strDate);
        reload();
    });



});

function createCookie(strDate) {
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

    createCookie(getNextWeekDate());

});

