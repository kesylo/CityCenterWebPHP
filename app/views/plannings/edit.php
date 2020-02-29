<!--add header-->
<?php require APPROOT . '/views/includes/header.php';
/*print_r($data);*/
?>

<div class="row">
    <div class="col-md-9 mx-auto py-lg-5 py-md-5">
        <div class="card shadow mb-4 border-bottom-success">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-primary text-center">Modifier une disponibilité</h1>
            </div>
            <div class="card-body">
                <div class="col-md-7 mx-auto">
                    <form action="<?php echo URLROOT; ?>/plannings/edit/<?php echo $data['id_planning']; ?>/<?php echo ($data['admin'] == 1 ?  1 : 0) ; ?>" method="post">


                        <div class="form-group">

                            Semaine du :
                            <div class="input-group date" id="weekDatePickerEdit" data-target-input="nearest">
                                <input type="text" name="week" class="form-control datetimepicker-input"
                                       data-target="#weekDatePickerEdit" value="<?php echo $data['week']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#weekDatePickerEdit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                            <hr>

                            Date :
                            <div class="input-group date" id="dayDatePickerEdit" data-target-input="nearest">
                                <input type="text" name="date"
                                       class="form-control datetimepicker-input <?php echo (!empty($data['date_err'])) ? 'is-invalid' : ''; ?>"
                                       data-target="#dayDatePickerEdit" value="<?php echo $data['date']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#dayDatePickerEdit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                            Heure de début:
                            <div class="input-group date" id="timeStartEdit" data-target-input="nearest">
                                <input type="text" name="startTime" data-target="#timeStartEdit"
                                       class="form-control datetimepicker-input <?php echo (!empty($data['timeStart_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['startTime']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#timeStartEdit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                </div>
                            </div>

                            Heure de fin:
                            <div class="input-group date" id="timeEndEdit" data-target-input="nearest">
                                <input type="text" name="endTime" data-target="#timeEndEdit"
                                       class="form-control datetimepicker-input <?php echo (!empty($data['timeEnd_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['endTime']; ?>"
                                       onkeydown="return false;"
                                />
                                <div class="input-group-append" data-target="#timeEndEdit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                </div>
                            </div>

                            <!-- hidden input to store data -->
                            <input name="status" type="hidden" value="<?php echo $data['status']; ?>"/>
                        </div>


                        <p class="text-center"> Redirection des appels:</p>
                        <div class="radio-group text-center mt-2">
                            <label class="radio">
                                <input type="radio" name="callRedirect" <?php echo (($data['callRedirect']) == "Oui") ? 'Checked' : ''; ?> value="Oui"> Oui
                                <span></span>
                            </label>
                            <label class="radio">
                                <input type="radio" name="callRedirect" <?php echo (($data['callRedirect']) == "Non") ? 'Checked' : ''; ?> value="Non"> Non
                                <span></span>
                            </label>
                        </div>


                        <hr>


                        <div class="text-center">
                            <a href="<?php
                                        if ($data['admin'] == 1){
                                            echo URLROOT . "/plannings/admin";
                                        }else{
                                            echo URLROOT . "/plannings/dashboard";
                                        }
                                    ?>" class="btn btn-secondary mr-5">Retour</a>

                            <input type="submit" value="Modifier" class="btn btn-success">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function () {

        let weekDateString;
        let dayDateString;

        weekDateString = "<?php echo $data['week']; ?>";
        dayDateString = "<?php echo $data['date']; ?>";

        $('#weekDatePickerEdit').datetimepicker({
            format: 'DD-MM-YYYY',
            date : moment(weekDateString, 'DD-MM-YYYY'),
            daysOfWeekDisabled:[0,2,3,4,5,6],
            locale:  moment.locale('fr', {
                week: { dow: 1 }
            }),
        });

        let min = moment(weekDateString, 'DD-MM-YYYY');
        let minCl = min.clone();
        let max = minCl.add(6, 'days');

        $('#dayDatePickerEdit').datetimepicker({
            format: 'DD-MM-YYYY',
            date : moment(dayDateString, 'DD-MM-YYYY'),
            minDate: min,
            maxDate : max,
            locale:  moment.locale('fr', {
                week: { dow: 1 }
            }),
        });

        $("#weekDatePickerEdit").on("change.datetimepicker", function (e) {
            let current = e.date.clone();
            let current2 = e.date.clone();

            $('#dayDatePickerEdit').datetimepicker("destroy");
            $('#dayDatePickerEdit').datetimepicker({
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
    });
</script>








<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>