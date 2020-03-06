<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>


<div class="row mt-5">
    <div class="col-md-9 mx-auto col-12">

        <div class="card shadow mb-4 border-bottom-success">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-primary text-center">Ajoutez votre planning</h1>
            </div>
            <div class="card-body">


                <div class="col-md-7 mx-auto">
                    <form action="<?php echo URLROOT; ?>/plannings/add" method="post">


                        <div class="form-group">

                            Semaine du :
                            <div class="input-group date" id="weekAdd" data-target-input="nearest">
                                <input type="text" name="week" class="form-control datetimepicker-input"
                                       data-target="#weekAdd" value="<?php echo $data['week']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#weekAdd" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                            <hr>

                            Date :
                            <div class="input-group date" id="dayAdd" data-target-input="nearest">
                                <input type="text" name="date"
                                       class="form-control datetimepicker-input <?php echo !empty($data['date_err'])
                                       	? 'is-invalid'
                                       	: ''; ?>"
                                       data-target="#dayAdd" value="<?php echo $data['date']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#dayAdd" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                            Heure de début:
                            <div class="input-group date" id="timeStart" data-target-input="nearest">
                                <input type="text" name="startTime" data-target="#timeStart"
                                       class="form-control datetimepicker-input <?php echo !empty(
                                       	$data['timeStart_err']
                                       )
                                       	? 'is-invalid'
                                       	: ''; ?>"
                                       value="<?php echo $data['startTime']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#timeStart" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                </div>
                            </div>

                            Heure de fin:
                            <div class="input-group date" id="timeEnd" data-target-input="nearest">
                                <input type="text" name="endTime" data-target="#timeEnd"
                                       class="form-control datetimepicker-input <?php echo !empty($data['timeEnd_err'])
                                       	? 'is-invalid'
                                       	: ''; ?>"
                                       value="<?php echo $data['endTime']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#timeEnd" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                </div>
                            </div>


                        </div>


                        <p class="text-center"> Redirection des appels:</p>
                        <div class="radio-group text-center mt-2">
                            <label class="radio">
                                <input type="radio" name="callRedirect" value="Oui"> Oui
                                <span></span>
                            </label>
                            <label class="radio">
                                <input type="radio" name="callRedirect" checked value="Non"> Non
                                <span></span>
                            </label>
                        </div>

                        <hr>

                        <div class="text-center">
                            <a href="<?php echo URLROOT; ?>/plannings/dashboard"
                               class="btn btn-secondary mr-5">Retour</a>
                            <input type="submit" value="Ajouter" class="btn btn-success">
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>
</div>

<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>

<script>

    const dateWeekUser = moment(getCookie("weekAdd"), 'DD-MM-YYYY');
    $("#weekAdd").datetimepicker({
        format: "DD-MM-YYYY",
        date: dateWeekUser,
        daysOfWeekDisabled: [0, 2, 3, 4, 5, 6],
        locale: moment.locale("fr", {
            week: { dow: 1 }
        })
    });

    const minClUser = dateWeekUser.clone();
    const maxUser = minClUser.add(6, 'days');

    $("#dayAdd").datetimepicker({
        format: 'DD-MM-YYYY',
        minDate: dateWeekUser,
        maxDate : maxUser,
        locale:  moment.locale('fr', {
            week: { dow: 1 }
        }),
    });

    // set globally
    $("#weekAdd").on("change.datetimepicker", function(e) {
        setCookie('weekAdd', moment(e.date).format('DD-MM-YYYY'))
    });
    $("#dayAdd").on("change.datetimepicker", function(e) {
        setCookie('dayAdd', moment(e.date).format('DD-MM-YYYY'))
    });

    // retrieve
    const dateWeekAdd = getCookie("weekAdd");
    const dateDayAdd = getCookie("dayAdd");
    $("#weekAdd").datetimepicker("date", moment(dateWeekAdd, "DD-MM-YYYY"));
    $("#dayAdd").datetimepicker("date", moment(dateDayAdd, "DD-MM-YYYY"));

    $("#weekAdd").on("change.datetimepicker", function (e) {
        const currentAdd = e.date.clone();
        const current2Add = e.date.clone();

        $("#dayAdd").datetimepicker("destroy");
        $("#dayAdd").datetimepicker({
            format: 'DD-MM-YYYY',
            minDate: currentAdd,
            date : current2Add,
            maxDate: e.date.add(6, "day"),
            autoClose: true,
            locale:  moment.locale('fr', {
                week: { dow: 1 }
            }),
        });
    });
</script>
