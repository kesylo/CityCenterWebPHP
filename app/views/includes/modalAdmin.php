

<form action="<?php echo URLROOT; ?>/plannings/edit/<?php echo $d['id']; ?>/1?status=Accepté">

    <a href="#" onclick="this.parentNode.submit()" id="editLink"
       class="card-link <?php echo $d["status"] == "Accepté"
       	? "text-success"
       	: ($d["status"] == "Refusé"
       		? "text-danger"
       		: ""); ?>" data-toggle="tooltip" title="Modifier" data-placement="top">

        <?php echo $d["time"]; ?>
    </a>
</form>


<!-- accept -->
<a href="<?php echo URLROOT; ?>/plannings/accept/<?php echo $d['id']; ?>/<?php echo $user->email; ?>"
   class="text-success <?php echo $d["status"] == "Accepté" ? "disabled" : ""; ?>" style="text-decoration: none"
   onclick="return confirm('Accepter cet element ?')"
   data-toggle="tooltip" title="Accepter" data-placement="left">
    <i class="fa fa-check"></i>
</a>

<!-- deny -->
<a href="<?php echo URLROOT; ?>/plannings/deny/<?php echo $d['id']; ?>/<?php echo $user->email; ?>"
   class="text-warning <?php echo $d["status"] == "Refusé" ? "disabled" : ""; ?>" style="text-decoration: none"
   onclick="return confirm('Refuser cet element ?')"
   data-toggle="tooltip" title="Refuser" data-placement="bottom">
    <i class="fa fa-times"></i>
</a>

<!-- delete -->
<a href="<?php echo URLROOT; ?>/plannings/delete/<?php echo $d['id']; ?>/1"
   class="text-danger " style="text-decoration: none"
   onclick="return confirm('Supprimer cet element ?')"
   data-toggle="tooltip" title="Supprimer" data-placement="bottom">
    <i class="fa fa-trash"></i>
</a>




<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $d['id']; ?>" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?php echo $name; ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h6 class="modal-title" style="font-weight:bold">
                <?php echo dateToFrench($d['date'], "l j F Y"); ?>
            </h6>
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




                    <!--Delete-->
                    <form action="<?php echo URLROOT; ?>/plannings/delete/<?php echo $d['id']; ?>/1"
                          method="post" onclick="return confirm('Voulez-vous supprimer ce planning ?')">
                        <button type="submit" class="btn btn-dark ml-2">
                            <i class="fa fa-trash"></i>
                            Supprimer
                        </button>
                    </form>
                </div>

            </div>
            <div class="modal-footer">

                <div class="row justify-content-center align-items-center">

                    <?php if ($d["status"] == "Accepté") { ?>
                        <div class="mr-2 my-auto">
                            <span class="text-success" style="font-weight:bold">
                                    Planning accepté
                            </span>
                        </div>
                    <?php } elseif ($d["status"] == "En attente") { ?>
                        <div class="mr-2 my-auto">
                            <span class="text-primary" style="font-weight:bold">
                                    Planning en attente
                            </span>
                        </div>
                    <?php } else { ?>
                        <div class="mr-2 my-auto">
                            <span class="text-danger" style="font-weight:bold">
                                    Planning refusé
                            </span>
                        </div>
                    <?php } ?>

                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>