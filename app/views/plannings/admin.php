<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>


<?php
setlocale (LC_TIME, 'fr_FR','FRA');
date_default_timezone_set("Europe/Paris");
mb_internal_encoding("UTF-8");

flash("planning_message");
?>


<div class="row">

    <div id="col" class="mr-2 my-auto">
        <span style="font-weight:bold">
            Semaine du:
        </span>
    </div>

    <div class="mr-5 ml-0">
        <div class="input-group date" id="dateWeekDash" data-target-input="nearest">
            <input type="text" name="week" class="form-control datetimepicker-input" data-target="#dateWeekDash" />
            <div class="input-group-append" data-target="#dateWeekDash" data-toggle="datetimepicker">
                <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <!--checkbox Waiting plannings-->
    <div class="my-auto pull-right">
        <span style="font-weight:bold">
            <input type="checkbox" id="waitingCheck"> En attente
        </span>
    </div>


</div>

<hr class="my-4">

<div id="card-reload">
    <?php require APPROOT . '/views/pages/listPlanningAdmin.php'; ?>
</div>

<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>