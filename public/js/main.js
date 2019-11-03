
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

        //console.log(strDate);
        createCookieDate(strDate);
        reload();
    });

    $('#exampleModal').on('show.bs.modal', function (event) {

        $(this).find('form').trigger('reset');

        let button = $(event.relatedTarget); // Button that triggered the modal
        let recipient = button.data('whatever');




        //console.log(recipient);
        let modal = $(this);

        modal.find('.modal-title').text('New message to ' + recipient);
    })

    $('#exampleModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    })

});


function confirmDelete() {
    if (confirm("Are you sure you want to delete")) {
        document.location = "/plannings/delete";
    }
}

function deleteRow(rowId) {

    let mysql = require('mysql');

    let host = '<?php echo DB_HOST ?>' ;
    let user = '<?php echo DB_USER ?>' ;
    let pwd = '<?php echo DB_PASS ?>' ;
    let dbName = '<?php echo DB_NAME ?>' ;


    let con = mysql.createConnection({
        host: host,
        user: user,
        password: pwd,
        database: dbName
    });


    con.connect(function(err) {
        if (err) throw err;
        con.query("DELETE FROM planning WHERE id_planning = $rowId", function (err, result) {
            if (err) throw err;
            console.log(result);
        });
    });


    console.log(rowId);
}

function sendToSession(rowId) {
    if (confirm(rowId)) {
        deleteRow(rowId);
    }
}

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

