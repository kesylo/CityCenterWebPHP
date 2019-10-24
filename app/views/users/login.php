<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>


<div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
        <!--receive data array and display-->
        <h1 class="display-3"> Se connecter </h1>
        <p class="lead">Vous ne pouvez pas créer de profils depuis cette plateforme</p>
    </div>
</div>

<div class="row">
    <div class="col-md-5 mx-auto">
        <div class="card card-body bg-light mt-1">
            <p>Veuillez remplir vos informations d'identification pour vous connecter</p>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="text-center">
                    <input type="submit" value="Connexion" class="btn btn-success">
                </div>
            </form>
        </div>

    </div>
</div>




<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>