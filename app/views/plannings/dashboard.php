<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>

<?php
    setlocale (LC_TIME, 'fr_FR','FRA');
    date_default_timezone_set("Europe/Paris");
    mb_internal_encoding("UTF-8");

    flash("planning_message");
?>



<div class="jumbotron text-center gradient">
    <h1 class="display-4">Mode Utilisateur</h1>
    <p class="lead">Cet outil vous permet d'ajouter, modifier ou supprimer vos plannings au fils du temps. </p>
</div>

<div class="row">

    <div class="d-inline-block col-md-6">

        <div id="col" class="d-inline-block mr-2 ml-0 my-auto">
            <span style="font-weight:bold">
                Semaine du:
            </span>
        </div>

        <div class="mr-2 ml-0 d-inline-block" >
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

    <div class="d-inline-block col-md-6">
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
