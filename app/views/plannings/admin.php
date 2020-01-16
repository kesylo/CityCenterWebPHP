<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>

<?php
    setlocale (LC_TIME, 'fr_FR','FRA');
    date_default_timezone_set("Europe/Paris");
    mb_internal_encoding("UTF-8");
    flash("planning_message");
?>

<!-- Jumbotron -->
<div class="jumbotron text-center redGradient">
    <h1 class="display-2" style="color: white">Mode Admin</h1>
    <p class="lead" style="color: white">Vous pouvez accepter, refuser ou modifier un planning.
        Un email sera envoyé à l'utilisateur une fois qu'une de ces actions sera effectuée.</p>
</div>

<hr >

<div class="row">
    <div id="card-reload" class="col-12">



        <?php require APPROOT . '/views/pages/listPlanningAdmin.php'; ?>
    </div>


    <!--add footer-->
    <?php require APPROOT . '/views/includes/footer.php'; ?>

</div>


