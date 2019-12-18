<!--add header-->
<?php require APPROOT . '/views/includes/header.php'; ?>


<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card o-hidden border-1 shadow-lg my-lg-5">
            <div class="row justify-content-center align-items-center card-body p-0">
                <div class="col-lg-6 d-none d-sm-block">
                    <img src="<?php echo URLROOT; ?>/images/img1.png" class="img-fluid" alt="Responsive image">
                </div>

                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Bienvenue!</h1>
                        </div>

                        <p class="text-center">Veuillez remplir vos informations</p>
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

                            <hr class="my-4">

                            <div class="text-center">
                                <input type="submit" value="Connexion" class="btn btn-success">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--add footer-->
<?php require APPROOT . '/views/includes/footer.php'; ?>