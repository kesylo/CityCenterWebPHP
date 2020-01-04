<?php /** @var TYPE_NAME $data */
include APPROOT . "/views/session.php";
if (sizeof($data['plannings']) > 0) :
    foreach ($data['plannings'] as $planning) : ?>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary d-inline"><?php echo fullDate($planning->date); ?></h6>
                <h6 class="m-0 font-weight-bold pull-right d-inline"><?php echo $data['unique'][$planning->id_user]; ?></h6>
            </div>
            <div class="card-body">

                <div class="row mb-2 ">
                    <div class="col-md-4">

                        <span style="font-weight:bold">
                            Plage horaire:
                        </span>
                        <span style="font-weight:normal">
                                <?php echo $planning->startTime . ' - ' . $planning->endTime ?>
                        </span>

                        <br>

                        <span style="font-weight:bold">
                                Rédirection:
                        </span>
                        <span style="font-weight:normal">
                                <?php echo $planning->callRedirect ?>
                        </span>

                    </div>

                    <div class="col-md-4">
                        <p class=" text-center" style="font-weight:bold">
                            Status:
                            <span style="font-weight:normal">
                                <?php
                                if ($planning->status == 'Accepté') {
                                    echo '<b class="text-success">Accepté</b>';
                                } elseif ($planning->status == 'Refusé') {
                                    echo '<b class="text-danger">Refusé</b>';
                                } else {
                                    echo '<b>En attente</b>';
                                }
                                ?>
                            </span>
                        </p>
                    </div>

                    <div class="col-md-4">

                        <!--Deny-->
                        <form action="<?php echo URLROOT; ?>/plannings/deny/<?php echo $planning->id_planning; ?>/<?php echo $data['emails'][$planning->id_user]; ?>"
                              method="post" onclick="return confirm('Refuser ce planning ?')">
                            <button type="submit" class="btn btn-warning pull-right ml-2">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>

                        <!--edit-->
                        <a href="<?php echo URLROOT; ?>/plannings/edit/<?php echo $planning->id_planning; ?> "
                           class="btn btn-primary pull-right ml-2">
                            <i class="fa fa-edit"></i>
                            <!--change global var to know where we nav from-->
                            <?php $_COOKIE['edit_on_admin'] = true; ?>
                        </a>


                        <!--Confirm-->
                        <form action="<?php echo URLROOT; ?>/plannings/accept/<?php echo $planning->id_planning; ?>/<?php echo $data['emails'][$planning->id_user]; ?>"
                              method="post" onclick="return confirm('Accepter ce planning ?')">
                            <button type="submit" class="btn btn-success pull-right ml-2">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>


                        <!--Delete-->
                        <form action="<?php echo URLROOT; ?>/plannings/delete/<?php echo $planning->id_planning; ?>"
                              method="post" onclick="return confirm('Voulez-vous supprimer ce planning ?')">
                            <button type="submit" class="btn btn-danger pull-right ml-2">
                                <i class="fa fa-trash"></i>
                                <!--change global var to know where we nav from-->
                                <?php $_SESSION['edit_on_admin'] = true; ?>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

<?php else: ?>
    <div class="text-center mb-3">
        <h1>Pas de données pour cette semaine !</h1>
        <img src="<?php echo URLROOT; ?>/images/img1.png" class="img-fluid" alt="Responsive image" width="700">
    </div>

<?php endif; ?>