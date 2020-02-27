<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>


<div class="row mt-5">
    <div class="col-md-9 mx-auto col-12">

        <div class="card shadow mb-4 border-bottom-warning">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-primary text-center">Ajoutez les heures éffectives</h1>
            </div>
            <div class="card-body">


                <div class="col-md-7 mx-auto">
                    <form action="<?php echo URLROOT; ?>/plannings/addEffective" method="post">


                        <div class="form-group">

                            Semaine du :
                            <div class="input-group date" id="weekAdd" data-target-input="nearest">
                                <input type="text" name="week" class="form-control datetimepicker-input"
                                       data-target="#weekAdd"
                                       disabled='disabled'
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
                                       class="form-control datetimepicker-input"
                                       data-target="#dayAdd"
                                       disabled='disabled'
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
                            <input type="submit" value="Ajouter" class="btn btn-warning">
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function () {

        $('#dayDatePickerAE').datetimepicker({
            format: 'DD-MM-YYYY',
            date : moment(moment(), 'DD-MM-YYYY'),
            locale:  moment.locale('fr', {
                week: { dow: 1 }
            }),
        });
    });
</script>


<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>
