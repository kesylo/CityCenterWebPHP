<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>


<?php
setlocale (LC_TIME, 'fr_FR','FRA');
date_default_timezone_set("Europe/Paris");
mb_internal_encoding("UTF-8");

flash("planning_message");
?>

<div class="row">
    <div class="jumbotron text-center col-12 redGradient">
        <h1 class="display-4" style="color: white">Mode Admin</h1>
        <p class="lead" style="color: white">Vous pouvez accepter, refuser ou modifier un planning. un email sera envoyé à l'utilisateur une fois qu'une de ces actions sera effectuée.  </p>
    </div>
</div>

<div class="row justify-content-center">



    <div class="radio-group text-center mt-2">

    </div>

</div>

<div class="row justify-content-center align-items-center">

    <div class="col-sm col-md-4">
        <div class="mr-2 my-auto">
        <span style="font-weight:bold">
            Semaine du:
        </span>
        </div>

        <div class="mr-5">
            <div class="input-group date" id="dateWeekDash" data-target-input="nearest">
                <input type="text" name="week" class="form-control datetimepicker-input" data-target="#dateWeekDash" />
                <div class="input-group-append" data-target="#dateWeekDash" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div>
    <hr >
</div>

<div class="row">
    <div id="card-reload" class="col-12">

        <?php
/*        $d = strtotime($_COOKIE["nextWeekDate"]);
        $date = date('d-m-Y', $d);
        */?><!--
        <h1 class="display-4"><?php /*echo date('F', strtotime($date )); */?></h1>-->

        <?php require APPROOT . '/views/pages/listPlanningAdmin.php'; ?>
    </div>
</div>

<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>