<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>


<?php
setlocale (LC_TIME, 'fr_FR','FRA');
date_default_timezone_set("Europe/Paris");
mb_internal_encoding("UTF-8");

flash("planning_message");
?>

<div class="row justify-content-center align-items-center">

    <div class="jumbotron text-center col-12 infoGradient">
        <h1 class="display-6" style="color: white">Mode Admin</h1>
        <p class="lead" style="color: white">Vous pouvez accepter, refuser ou modifier un planning. un email sera envoyé à l'utilisateur une fois qu'une de ces actions sera effectuée.  </p>

        <h6 style="color: white">Légende:
            <span class="badge badge-success">Accepté</span>
            <span class="badge badge-primary">En attente</span>
            <span class="badge badge-danger">Refusé</span>
        </h6>
    </div>
</div>

<div class="row justify-content-center align-items-center">

    <div class="mr-2 my-auto">
        <span style="font-weight:bold">
            Semaine du:
        </span>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 text-center mb-2 mb-md-0" >
        <div class="input-group date" id="weekDatePickerAdmin" data-target-input="nearest">
            <input type="text" name="week" class="form-control datetimepicker-input" data-target="#weekDatePickerAdmin"/>
            <div class="input-group-append" data-target="#weekDatePickerAdmin" data-toggle="datetimepicker">
                <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-7 col-md-5 col-lg-4 col-xl-3 text-center" >
        <a href="<?php echo URLROOT; ?>/plannings/bulkAdd" class="btn btn-info">
            <i class="fa fa-plus"></i> Plusieurs disponibilités
        </a>
    </div>

</div>

<hr >

<div id="card-reload" class="pb-5">
    <?php require APPROOT . '/views/pages/listPlanningAdmin.php'; ?>
</div>

<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>