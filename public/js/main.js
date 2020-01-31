/*
$('input[name="radioWaiting"]').change(function(){
    if($('#radiowaiting1').prop('checked')){
        document.cookie = "waiting" + "=" + "all";
        reload();
    }
    if($('#radiowaiting2').prop('checked')){
        document.cookie = "waiting" + "=" + "waiting";
        reload();
    }
});*/

$(function () {

    //region common DatePickers
    // Week date picker
    $('#weekDatePicker').datetimepicker({
        format: 'DD-MM-YYYY',
        date : moment(moment().startOf('isoWeek').add(1, 'week'), 'DD-MM-YYYY'),
        minDate : moment(moment().startOf('isoWeek').subtract(1, 'days'), 'DD-MM-YYYY'),
        maxDate : moment(moment().startOf('isoWeek').add(2, 'week'), 'DD-MM-YYYY'),
        daysOfWeekDisabled:[0,2,3,4,5,6],
        locale:  moment.locale('fr', {
            week: { dow: 1 }
        }),
    });

    let min = moment(moment().startOf('isoWeek').add(1, 'week'), 'DD-MM-YYYY');
    let minCl = min.clone();
    let max = minCl.add(6, 'days');

    // Day Datepicker
    $('#dayDatePicker').datetimepicker({
        format: 'DD-MM-YYYY',
        date : moment(moment().startOf('isoWeek').add(1, 'week'), 'DD-MM-YYYY'),
        minDate: min,
        maxDate : max,
        locale:  moment.locale('fr', {
            week: { dow: 1 }
        }),
    });

    $("#weekDatePicker").on("change.datetimepicker", function (e) {
        let current = e.date.clone();
        let current2 = e.date.clone();

        $('#dayDatePicker').datetimepicker("destroy");
        $('#dayDatePicker').datetimepicker({
            format: 'DD-MM-YYYY',
            ignoreReadonly: true,
            minDate: current,
            date : current,
            maxDate: e.date.add(6, "day"),
            autoClose: true,
            locale:  moment.locale('fr', {
                week: { dow: 1 }
            }),
        });

        // set globally
        let strDate = moment(current2).format('DD-MM-YYYY');
        createCookieDate(strDate);
        reload();
    });


    //endregion ---------------------------------------------------------------------------------------

    //region Bulk add DatePickers
    $('#weekDatePickerBulk').datetimepicker({
        format: 'DD-MM-YYYY',
        date : moment(moment().startOf('isoWeek'), 'DD-MM-YYYY'),
        daysOfWeekDisabled:[0,2,3,4,5,6],
        locale:  moment.locale('fr', {
            week: { dow: 1 }
        }),
    });

    let min2 = moment(moment().startOf('isoWeek'), 'DD-MM-YYYY');
    let minCl2 = min2.clone();
    let max2 = minCl2.add(6, 'days');

    // Day Datepicker
    $('#dayDatePickerBulk').datetimepicker({
        format: 'DD-MM-YYYY',
        date : moment(moment().startOf('isoWeek'), 'DD-MM-YYYY'),
        minDate: min2,
        maxDate : max2,
        locale:  moment.locale('fr', {
            week: { dow: 1 }
        }),
    });

    $("#weekDatePickerBulk").on("change.datetimepicker", function (e) {
        let current = e.date.clone();
        let current2 = e.date.clone();

        $('#dayDatePickerBulk').datetimepicker("destroy");
        $('#dayDatePickerBulk').datetimepicker({
            format: 'DD-MM-YYYY',
            ignoreReadonly: true,
            minDate: current,
            date : current,
            maxDate: e.date.add(6, "day"),
            autoClose: true,
            locale:  moment.locale('fr', {
                week: { dow: 1 }
            }),
        });

        // set globally
        let strDate = moment(current2).format('DD-MM-YYYY');
        createCookieDate(strDate);
        reload();
    });
    //endregion

    //region TimePickers
    $('#timeStart').datetimepicker({
        format: 'HH:mm',
        stepping: 15,
        forceMinuteStep: true,
    });

    $('#timeEnd').datetimepicker({
        format: 'HH:mm',
        stepping: 15,
        forceMinuteStep: true,
    });
    //endregion

    // combobox change event
    $('#dropDownBulk').change(function(){
        //console.log("selected " + $("#dropDownBulk").prop('selectedIndex'));
        createCookie("idSelectedUser", $("#dropDownBulk").prop('selectedIndex'));
    });

    /*// cleave.js
    new Cleave('.timePicker', {
        time: true,
        timePattern: ['h', 'm']
    });*/

});


function createCookieDate(strDate) {
    document.cookie = "nextWeekDate" + "=" + strDate;
}

function createCookie (varName, value) {
    document.cookie = varName + "=" + value;
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
    return dd + '-' + mm + '-' + yyyy;
}

$(window).bind('beforeunload',function(){
    createCookieDate(getNextWeekDate());
    createCookie("idSelectedUser", $("#dropDownBulk").prop('selectedIndex'));
});
