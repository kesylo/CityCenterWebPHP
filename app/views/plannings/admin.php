<?php
require APPROOT . '/views/includes/header.php';
flash("planning_message");
?>

<div class="container-fluid">
    <div class="jumbotron text-center col-12 infoGradient">
        <h1 class="display-6" style="color: white">Mode Administrateur</h1>
        <p class="lead" style="color: white">
            Vous pouvez accepter, refuser ou modifier un planning.
            Un email sera envoyé à l'utilisateur de ce fait.
        </p>

        <h6 style="color: white">Légende:
            <span class="badge badge-success">Accepté</span>
            <span class="badge badge-primary">En attente</span>
            <span class="badge badge-danger">Refusé</span>
        </h6>
    </div>
</div>


<div class="d-flex justify-content-center align-items-center container">
    <div class="row justify-content-center">
        <div class="col">
            <span style="font-weight:bold">
                    Semaine du:
            </span>
        </div>

        <div class="w-100"></div>

        <div class="col-12 col-md-4 col-lg-6 mb-3">
            <div class="input-group date" id="weekAdminMode" data-target-input="nearest">
                <input type="text" name="week" class="form-control datetimepicker-input"
                       data-target="#weekAdminMode" value="12-12-2019"/>
                <div class="input-group-append" data-target="#weekAdminMode" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-6">
            <a href="<?php echo URLROOT; ?>/plannings/bulkAdd" class="btn btn-info">
                <i class="fa fa-plus"></i> Plusieurs disponibilités
            </a>
        </div>
    </div>
</div>

<div class="container-fluid mb-4">
    <hr class="">
</div>

<div id="card-reload" class="pb-5">
    <?php require APPROOT . '/views/pages/listPlanningAdmin.php'; ?>
</div>

<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>
