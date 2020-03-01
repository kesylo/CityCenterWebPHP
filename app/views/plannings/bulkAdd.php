<!--add header-->
<?php
require APPROOT . '/views/includes/header.php';
flash("planning_message");
sort($users);


?>


<div class="row mt-5">
    <div class="col-md-9 mx-auto col-12">

        <div class="card shadow mb-4 border-bottom-warning">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-info text-center">Ajoutez plusieurs disponibilités</h1>
            </div>
            <div class="card-body">


                <div class="col-md-7 mx-auto">
                    <form action="<?php echo URLROOT; ?>/plannings/bulkAdd" method="post">


                        <div class="form-group">

                            Utilisateur :
                            <div class="input-group">
                                <select class="form-control" name="idBulk" id="dropDownBulk">
                                    <?php foreach ($users as $key => $user) : ?>
                                        <option <?php echo (isset($_COOKIE["idSelectedUser"])
                                            && $_COOKIE["idSelectedUser"] == $key) ? "selected" : "" ?>>
                                            <?php echo $user->firstName . " " . $user->lastName?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <hr>

                            Semaine du :
                            <div class="input-group" id="weekBulk" data-target-input="nearest">
                                <input type="text" name="week" class="form-control datetimepicker-input"
                                       data-target="#weekBulk" value="<?php echo $_COOKIE['weekBulk']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#weekBulk" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                            Date :
                            <div class="input-group" id="dayBulk" data-target-input="nearest">
                                <input type="text" name="date"
                                       class="form-control datetimepicker-input <?php echo (!empty($data['date_err'])) ? 'is-invalid' : ''; ?>"
                                       data-target="#dayBulk"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#dayBulk" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                            Heure de début:
                            <div class="input-group" id="timeStart" data-target-input="nearest">
                                <input type="text" name="startTime" data-target="#timeStart"
                                       class="form-control datetimepicker-input <?php echo (!empty($data['timeStart_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['startTime']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#timeStart" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                </div>
                            </div>

                            Heure de fin:
                            <div class="input-group" id="timeEnd" data-target-input="nearest">
                                <input type="text" name="endTime" data-target="#timeEnd"
                                       class="form-control datetimepicker-input <?php echo (!empty($data['timeEnd_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['endTime']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#timeEnd" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                </div>
                            </div>

                            Description:
                            <div class="form-group" id="details" data-target-input="nearest">
                                <textarea name="details" rows="3" class="form-control">

                                </textarea>

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
                            <a href="<?php echo URLROOT; ?>/plannings/admin"
                               class="btn btn-secondary mr-5">Retour</a>

                            <!--<input type="submit" value="Ajouter" class="btn btn-warning">-->

                            <button type="submit" class="btn btn-warning">
                                Ajouter
                            </button>
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
    $("#weekBulk").datetimepicker({
        format: "DD-MM-YYYY",
        date: moment(moment().startOf("isoWeek"), "DD-MM-YYYY"),
        daysOfWeekDisabled: [0, 2, 3, 4, 5, 6],
        locale: moment.locale("fr", {
            week: { dow: 1 }
        })
    });

    let min = moment(getCookie("dayBulk"), 'DD-MM-YYYY');
    let minCl = min.clone();
    let max = minCl.add(6, 'days');

    $("#dayBulk").datetimepicker({
        format: 'DD-MM-YYYY',
        minDate: min,
        maxDate : max,
        locale:  moment.locale('fr', {
            week: { dow: 1 }
        }),
    });

    // set globally
    $("#weekBulk").on("change.datetimepicker", function(e) {
        setCookie('weekBulk', moment(e.date).format('DD-MM-YYYY'))
    });
    $("#dayBulk").on("change.datetimepicker", function(e) {
        setCookie('dayBulk', moment(e.date).format('DD-MM-YYYY'))
    });

    // retrieve
    const dateValue = getCookie("weekBulk");
    const dateValue2 = getCookie("dayBulk");
    $("#weekBulk").datetimepicker("date", moment(dateValue, "DD-MM-YYYY"));
    $("#dayBulk").datetimepicker("date", moment(dateValue2, "DD-MM-YYYY"));

    $("#weekBulk").on("change.datetimepicker", function (e) {
            const current = e.date.clone();
            const current2 = e.date.clone();

            $("#dayBulk").datetimepicker("destroy");
            $("#dayBulk").datetimepicker({
                format: 'DD-MM-YYYY',
                minDate: current,
                date : current2,
                maxDate: e.date.add(6, "day"),
                autoClose: true,
                locale:  moment.locale('fr', {
                    week: { dow: 1 }
                }),
            });
    });
</script>