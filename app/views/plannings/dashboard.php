<!--add header-->
<?php
require APPROOT . '/views/includes/header.php';
flash("planning_message");
$fRun = '';
if (!isset($_COOKIE['selectedTab'])) {
	$fRun = 'active';
} else {
	$fRun = '';
}
?>

<div class="jumbotron text-center col-12 gradient">
    <h1 class="display-6" style="color: white">Mode Utilisateur</h1>
    <p class="lead" style="color: white">Cet outil vous permet d'ajouter, modifier ou supprimer vos plannings au fils du temps.</p>

    <h6 style="color: white">Légende:
        <span class="badge badge-success">Accepté</span>
        <span class="badge badge-primary">En attente</span>
        <span class="badge badge-danger">Refusé</span>
    </h6>
</div>


<div class="row justify-content-center">
    <div class="col">
        <span style="font-weight:bold">
                Semaine du:
        </span>
    </div>

    <div class="w-100"></div>

    <div class="col-12 col-md-4 col-lg-3 mb-3">
        <div class="input-group date" id="weekUserMode" data-target-input="nearest">
            <input type="text" name="week" class="form-control datetimepicker-input" data-target="#weekUserMode"
            value="12-12-2019"/>
            <div class="input-group-append" data-target="#weekUserMode" data-toggle="datetimepicker">
                <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-9">

        <a href="<?php echo URLROOT; ?>/plannings/add" class="btn btn-success pull-right ml-2">
            <i class="fa fa-plus"></i> Ajouter une disponibilité
        </a>

        <a href="<?php echo URLROOT; ?>/plannings/addEffective" class="btn btn-warning pull-right">
            <i class="fa fa-plus"></i> Ajouter heures éffectives
        </a>
    </div>

</div>



<hr class="my-2">

<div id="card-reload">

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item" id="test">
                    <a class="nav-link <?php echo $fRun; ?> <?php echo $_COOKIE['selectedTab'] == 1 ? 'active' : ''; ?>"
                       id="home-tab" data-toggle="tab" href="#home" onclick="tab1()"
                       role="tab" aria-controls="home" aria-selected="true">Disponibilités
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $_COOKIE['selectedTab'] == 2 ? 'active' : ''; ?>"
                       id="profile-tab" data-toggle="tab" href="#profile" onclick="tab2()"
                       role="tab" aria-controls="profile" aria-selected="false">Heures Effectives
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $_COOKIE['selectedTab'] == 3 ? 'active' : ''; ?>"
                       id="table-tab" data-toggle="tab" href="#table" onclick="tab3()"
                       role="tab" aria-controls="table" aria-selected="false">Planning complet
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane m-2 <?php echo $fRun; ?> <?php echo $_COOKIE['selectedTab'] == 1 ? 'active' : ''; ?>"
                 id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- Content for first tab -->
                <?php require APPROOT . '/views/pages/listPlanning.php'; ?>
            </div>

            <div class="tab-pane m-2 <?php echo $_COOKIE['selectedTab'] == 2 ? 'active' : ''; ?>"
                 id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Content for second tab -->
                <?php require APPROOT . '/views/pages/listPlanningEffective.php'; ?>
            </div>

            <div class="tab-pane m-2 <?php echo $_COOKIE['selectedTab'] == 3 ? 'active' : ''; ?>"
                 id="table" role="tabpanel" aria-labelledby="table-tab">
                <!-- Content for third tab -->
                <?php require APPROOT . '/views/plannings/planningViewDashboard.php'; ?>
            </div>
        </div>
    </div>

</div>


<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>

<script>
    function tab1() {
        document.cookie = "selectedTab" + "=" + 1;
    }
    function tab2() {
        document.cookie = "selectedTab" + "=" + 2;
    }
    function tab3() {
        document.cookie = "selectedTab" + "=" + 3;
    }

</script>