<a data-toggle="modal" class="card-link <?php echo
    $d["status"] == "Accepté" ? ("text-success") :
    ($d["status"] == "Refusé" ? ("text-danger") : ("")) ?>"
   href="#" data-target="#myModal<?php echo $d['id'] ?>">

    <?php echo $d["time"]?>
</a>

<br>


<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $d['id'] ?>" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <?php echo $name?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Choisissez une action</p>

                <div class="row justify-content-center align-items-center">
                    <!--edit-->
                    <form action="<?php echo URLROOT; ?>/plannings/edit/<?php echo $d['id']; ?>/1">
                        <button type="submit" class="btn btn-primary ml-2">
                            <i class="fa fa-edit"></i>
                            Modifier
                        </button>
                    </form>

                    <!--Deny-->
                    <form action="<?php echo URLROOT; ?>/plannings/deny/<?php echo $d['id']; ?>/<?php echo $user->email; ?>"
                          method="post" onclick="return confirm('Refuser ce planning ?')">
                        <button type="submit" class="btn btn-warning ml-2">
                            <i class="fa fa-times"></i>
                            Refuser
                        </button>
                    </form>

                    <!--Confirm-->
                    <form action="<?php echo URLROOT; ?>/plannings/accept/<?php echo $d['id']; ?>/<?php echo $user->email; ?>"
                          method="post" onclick="return confirm('Accepter ce planning ?')">
                        <button type="submit" class="btn btn-success ml-2">
                            <i class="fa fa-check"></i>
                            Accepter
                        </button>
                    </form>


                    <!--Delete-->
                    <form action="<?php echo URLROOT; ?>/plannings/delete/<?php echo $d['id']; ?>/1"
                          method="post" onclick="return confirm('Voulez-vous supprimer ce planning ?')">
                        <button type="submit" class="btn btn-danger ml-2">
                            <i class="fa fa-trash"></i>
                            Supprimer
                        </button>
                    </form>
                </div>

            </div>
            <div class="modal-footer">

                <div class="row justify-content-center align-items-center">

                    <?php if($d["status"] == "Accepté"){ ?>
                        <div class="mr-2 my-auto">
                            <span class="text-success" style="font-weight:bold">
                                    Planning accepté
                            </span>
                        </div>
                    <?php } else if ($d["status"] == "En attente"){ ?>
                        <div class="mr-2 my-auto">
                            <span class="text-primary" style="font-weight:bold">
                                    Planning en attente
                            </span>
                        </div>
                    <?php } else {?>
                        <div class="mr-2 my-auto">
                            <span class="text-danger" style="font-weight:bold">
                                    Planning refusé
                            </span>
                        </div>
                    <?php }?>

                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>