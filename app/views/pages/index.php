<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> <?php echo SITENAME; ?> </title>

    <script src="<?php echo URLROOT; ?>/js/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/jquery-ui.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/jquery.easing.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">

    <!--datePicker-->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link href="<?php echo URLROOT; ?>/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo URLROOT; ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    
</head>

<body>

    <header class="gradient mb-2">

        <?php require APPROOT . '/views/includes/navbar.php'; ?>

        <div class="container mt-5">
            <h1 class="display-4">Application de gestion de plannings</h1>
            <p class="lead">Connectez vous avec vos identifiants crées sur l'ERP. Pour Créer un compte, veuillez contactez l'administrateur.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="<?php echo URLROOT; ?>/users/login">Connexion</a>
            </p>
        </div>



    </header>


<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>
