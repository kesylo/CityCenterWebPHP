<nav class="navbar navbar-expand-lg navbar-dark  portfolio-navbar gradient py-2 mb-3 shadow-sm">
    <a class="navbar-brand font-weight-bold" href="<?php echo URLROOT; ?>"><?php echo strtoupper(SITENAME); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">

            <!--show admin link if user is admin-->
            <?php if (isset($_SESSION['id']) && $_SESSION['role'] > 4) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/plannings/admin">Mode Administrateur</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/plannings/dashboard">Mode Utilisateur</a>
                </li>
            <?php endif; ?>
        </ul>

        <ul class="navbar-nav ml-auto">

            <?php if (isset($_SESSION['id'])) : ?>

                <div id="col" class="my-auto mr-4">
                    <span style="font-weight:bold">
                        <i class="fa fa-user"></i> <?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?>
                    </span>
                </div>


                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo URLROOT; ?>/users/logout">
                        Déconnexion  <i class="fa fa-power-off"></i>
                    </a>
                </li>

            <?php else: ?>

                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo URLROOT; ?>/users/login"> Connexion</a>
                </li>

            <?php endif; ?>

        </ul>

    </div>
</nav>
