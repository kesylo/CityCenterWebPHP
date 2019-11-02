<?php /** @var TYPE_NAME $data */
foreach ($data['plannings'] as $planning) : ?>

    <div class="card mb-2">
        <h6 class="card-header" style="font-weight:bold"><?php echo fullDate($planning->date); ?></h6>
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
                        Status: <span style="font-weight:normal"> <?php echo $planning->status ?> </span>
                    </p>
                </div>

                <div class="col-md-4">

                    <!--Modal for delete-->
                    <button type="button" class="btn btn-danger pull-right ml-2" value="" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-trash"></i>
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous supprimer ce planning ? <?php echo $planning->id_planning; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>

                                    <form action="<?php echo URLROOT; ?>/plannings/delete/<?php echo $planning->id_planning; ?>" method="post">
                                        <button type="submit" class="btn btn-danger pull-right ml-2" >Oui
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--edit-->
                    <a href="<?php echo URLROOT; ?>/plannings/edit/<?php echo $planning->id_planning; ?>" class="btn btn-primary pull-right ml-2"><i class="fa fa-edit"></i>  </a>

                </div>
            </div>

        </div>
    </div>

<?php endforeach; ?>