<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>

<?php
    setlocale (LC_TIME, 'fr_FR','FRA');
    date_default_timezone_set("Europe/Paris");
    mb_internal_encoding("UTF-8");

    flash("planning_message");

/*print_r($data);*/
//echo $_COOKIE["nextWeekDate"];
?>


<h1 class="text-center mb-5">Plannings</h1>

<div class="row mb-2">

    <div id="col" class="col-md-2 my-auto">
        <span style="font-weight:bold">
            Semaine du:
        </span>
    </div>

    <div class="col-md-2 container-fluid">
        <div class="input-group date" id="dateWeekDash" data-target-input="nearest">
            <input type="text" name="week" class="form-control datetimepicker-input" data-target="#dateWeekDash" />
            <div class="input-group-append" data-target="#dateWeekDash" data-toggle="datetimepicker">
                <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <a href="<?php echo URLROOT; ?>/plannings/add" class="btn btn-success pull-right">
            <i class="fa fa-plus"></i> Ajouter
        </a>

    </div>
</div>


<div id="card-reload">
    <?php require APPROOT . '/views/pages/listPlanning.php'; ?>
</div>



<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>
