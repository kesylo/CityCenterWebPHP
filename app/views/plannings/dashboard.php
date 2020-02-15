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
        <h1 class="display-6" style="color: white">Liste des disponibilités</h1>
        <p class="lead" style="color: white">Cet outil vous permet d'ajouter, modifier ou supprimer vos plannings au fils du temps.</p>

        <a href="<?php echo URLROOT; ?>/plannings/add" class="btn btn-dark">
            <i class="fa fa-eye"></i> Voir vos heures éffectives
        </a>
    </div>
</div>


<div class="row justify-content-center">
    <div class="col">
        <span style="font-weight:bold">
                Semaine du:
        </span>
    </div>

    <div class="w-100"></div>

    <div class="col-12 col-md-4 col-lg-3 mb-3">
        <div class="input-group date" id="weekDatePicker" data-target-input="nearest">
            <input type="text" name="week" class="form-control datetimepicker-input" data-target="#weekDatePicker" />
            <div class="input-group-append" data-target="#weekDatePicker" data-toggle="datetimepicker">
                <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-9">
        <!--<a href="<?php /*echo URLROOT; */?>/plannings/addExtra" class="btn btn-dark pull-right ml-2">
            <i class="fa fa-plus"></i> Ajouter un extra
        </a>-->

        <a href="<?php echo URLROOT; ?>/plannings/add" class="btn btn-success pull-right ml-2">
            <i class="fa fa-plus"></i> Ajouter une disponibilité
        </a>

        <a href="<?php echo URLROOT; ?>/plannings/addEffective" class="btn btn-warning pull-right">
            <i class="fa fa-plus"></i> Ajouter heures éffectives
        </a>
    </div>

</div>



<hr class="my-4">

<div id="card-reload">

    <?php if (sizeof($data['planningsEffective']) > 0) :
    foreach ($data['planningsEffective'] as $planning) : ?>

        <?php echo $planning; ?>

    <?php endforeach; ?>

    <?php else: ?>
        <div class="text-center mb-3">
            <h1>Pas de données pour cette semaine !</h1>
        </div>
    <?php endif; ?>

    <div class="w-100"></div>

    <?php require APPROOT . '/views/pages/listPlanning.php'; ?>
</div>



<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>
