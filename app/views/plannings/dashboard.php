<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>

<?php
    setlocale (LC_TIME, 'fr_FR','FRA');
    date_default_timezone_set("Europe/Paris");
    mb_internal_encoding("UTF-8");

    flash("planning_message");
?>

<div class="row">
    <div class="jumbotron text-center col-12 gradient" >
        <h1 class="display-4" style="color: white">Mode Utilisateur</h1>
        <p class="lead" style="color: white">Cet outil vous permet d'ajouter, modifier ou supprimer vos plannings au fils du temps.</p>
    </div>
</div>


<div class="row">
    <div class="col">
        <span style="font-weight:bold">
                Semaine du:
        </span>
    </div>

    <div class="w-100"></div>

    <div class="col-7 col-sm-7 col-md-4 col-lg-3">
        <div class="input-group date" id="dateWeekDash" data-target-input="nearest">
            <input type="text" name="week" class="form-control datetimepicker-input" data-target="#dateWeekDash" />
            <div class="input-group-append" data-target="#dateWeekDash" data-toggle="datetimepicker">
                <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-5 col-sm-5 col-md-8 col-lg-9">
        <a href="<?php echo URLROOT; ?>/plannings/add" class="btn btn-success pull-right">
            <i class="fa fa-plus"></i> Ajouter
        </a>
    </div>

</div>



<hr class="my-4">

<div id="card-reload">
    <?php require APPROOT . '/views/pages/listPlanning.php'; ?>
</div>



<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>
