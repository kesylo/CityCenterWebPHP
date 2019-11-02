<!--add header-->
<?php require APPROOT . '/views/includes/header.php';
/*print_r($data);*/
?>

<div class="row">
    <div class="col-md-9 mx-auto">
        <div class="card card-body bg-light mt-1">
            <h1 class="text-center">modifier un planning</h1>

            <div class="col-md-5 mx-auto">
                <form action="<?php echo URLROOT; ?>/plannings/edit/<?php echo $data['id_planning']; ?>" method="post">


                    <div class="form-group">

                        Semaine du :
                        <div class="input-group date" id="dateWeek" data-target-input="nearest">
                            <input type="text" name="week" class="form-control datetimepicker-input" data-target="#dateWeek" value="<?php echo $data['week']; ?>"/>
                            <div class="input-group-append" data-target="#dateWeek" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>

                        <hr>

                        Date :
                        <div class="input-group date" id="dateDisp" data-target-input="nearest">
                            <input type="text" name="date" class="form-control datetimepicker-input <?php echo (!empty($data['date_err'])) ? 'is-invalid' : ''; ?>" data-target="#dateDisp" value="<?php echo $data['date']; ?>"/>
                            <div class="input-group-append" data-target="#dateDisp" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>

                        Heure de début:
                        <div class="input-group date" id="timeStart" data-target-input="nearest">
                            <input type="text" name="startTime" data-target="#timeStart" class="form-control datetimepicker-input <?php echo (!empty($data['timeStart_err'])) ? 'is-invalid' : ''; ?>"  value="<?php echo $data['startTime']; ?>"/>
                            <div class="input-group-append" data-target="#timeStart" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                            </div>
                        </div>

                        Heure de fin:
                        <div class="input-group date" id="timeEnd" data-target-input="nearest">
                            <input type="text" name="endTime" data-target="#timeEnd" class="form-control datetimepicker-input <?php echo (!empty($data['timeEnd_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['endTime']; ?>"/>
                            <div class="input-group-append" data-target="#timeEnd" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                            </div>
                        </div>
                    </div>


                    Redirection des appels:<br>
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
                        <a href="<?php echo URLROOT; ?>/plannings/dashboard" class="btn btn-secondary">Retour</a>

                        <input type="submit" value="Modifier" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>











<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>