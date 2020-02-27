$(function() {
	//region User mode ---------------------------------------------------------------------------------------
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
	//endregion

	//region Linked datePickers create -----------------------------------------------------------------------
	$('#weekAdd').datetimepicker({
		format: 'DD-MM-YYYY',
		date : moment(moment().startOf('isoWeek'), 'DD-MM-YYYY'),
		daysOfWeekDisabled:[0,2,3,4,5,6],
		locale:  moment.locale('fr', {
			week: { dow: 1 }
		}),
	});

	const min = moment(moment().startOf('isoWeek'), 'DD-MM-YYYY');
	const minCl = min.clone();
	const max = minCl.add(6, 'days');

	$('#dayAdd').datetimepicker({
		format: 'DD-MM-YYYY',
		date : moment(new Date(), 'DD-MM-YYYY'),
		minDate: min,
		maxDate : max,
		locale:  moment.locale('fr', {
			week: { dow: 1 }
		}),
	});

	$("#weekAdd").on("change.datetimepicker", function (e) {
		let current = e.date.clone();

		$('#dayAdd').datetimepicker("destroy");
		$('#dayAdd').datetimepicker({
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
	});
	//endregion

	//region TimePickers -------------------------------------------------------------------------------------

	$('#timeStart').datetimepicker({
		format: 'HH:mm',
		stepping: 15,
		forceMinuteStep: true,
	});
	$('#timeStart').datetimepicker('date', moment(getCurrentTime(), 'HH:mm') );

	$('#timeEnd').datetimepicker({
		format: 'HH:mm',
		stepping: 15,
		forceMinuteStep: true,
	});
	//endregion

	// combobox change event ------------------------------------------------------------------------
	$("#dropDownBulk").change(function() {
		//console.log("selected " + $("#dropDownBulk").prop('selectedIndex'));
		createCookie("idSelectedUser", $("#dropDownBulk").prop("selectedIndex"));
	});
});

//region Functions ------------------------------------------------------------------------
function getCurrentTime() {
	const today = new Date();
	return today.getHours() + ":" + today.getMinutes();
}

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
