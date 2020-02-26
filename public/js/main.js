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

/*window.onload = function() {
	const dateValue = getCookie("weekUser")
	$("#weekUserMode").datetimepicker("date", moment("12-12-12", "DD-MM-YYYY"));
};*/

$(function() {
	//region User mode ---------------------------------------------------------------------------------------
	//let $dateVal = moment(moment().startOf("isoWeek"), "DD-MM-YYYY");

	$("#weekUserMode").datetimepicker({
		format: "DD-MM-YYYY",
		daysOfWeekDisabled: [0, 2, 3, 4, 5, 6],
		locale: moment.locale("fr", {
			week: { dow: 1 }
		})
	});

	const dateValue = getCookie("weekUser");
	$("#weekUserMode").datetimepicker("date", moment(dateValue, "DD-MM-YYYY"));

	$("#weekUserMode").on("change.datetimepicker", function(e) {
		let strDate = moment(e.date).format("DD-MM-YYYY");
		setCookie("weekUser", strDate);
		reload();
	});

	/*

	$("#weekUserMode").datetimepicker(
		"viewDate",
		moment("12-12-2019", "DD-MM-YYYY")
	);

	$("#weekUserMode").on("change.datetimepicker", function(e) {
		// set globally
		let strDate = moment(e.date).format("DD-MM-YYYY");
		/!*createCookie("weekUser", strDate);
		reload();*!/
	});*/

	//endregion

	/*$("#dayDatePicker").datetimepicker({
		format: "DD-MM-YYYY",
		date: moment(
			moment()
				.startOf("isoWeek")
				.add(1, "week"),
			"DD-MM-YYYY"
		),
		minDate: min,
		maxDate: max,
		locale: moment.locale("fr", {
			week: { dow: 1 }
		})
	});*/

	// combobox change event ------------------------------------------------------------------------
	$("#dropDownBulk").change(function() {
		//console.log("selected " + $("#dropDownBulk").prop('selectedIndex'));
		createCookie("idSelectedUser", $("#dropDownBulk").prop("selectedIndex"));
	});

	/*// cleave.js
    new Cleave('.timePicker', {
        time: true,
        timePattern: ['h', 'm']
    });*/
});

//region Functions ------------------------------------------------------------------------
function getCookie(cname) {
	let name = cname + "=";
	let ca = document.cookie.split(";");
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) === " ") {
			c = c.substring(1);
		}
		if (c.indexOf(name) === 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function setCookie(cname, cvalue) {
	let d = new Date();
	d.setTime(d.getTime() + 86400 * 30);
	let expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function reload() {
	$("#card-reload").load(" #card-reload");
}

$(window).bind("beforeunload", function() {
	//createCookie("idSelectedUser", $("#dropDownBulk").prop("selectedIndex"));
});
//endregion ------------------------------------------------------------------------
