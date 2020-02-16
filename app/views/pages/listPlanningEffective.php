<?php /** @var TYPE_NAME $data */

if (sizeof($data['planningsEffective']) > 0):
	foreach ($data['planningsEffective'] as $planning): ?>

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning"> <?php echo fullDate(
                	$planning->date
                ); ?>
                </h6>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">

                        <span style="font-weight:bold">
                            Plage horaire:
                        </span>
                        <span style="font-weight:normal">
                                <?php echo $planning->startTime .' - '.$planning->endTime; ?>
                        </span>

                    </div>

                    <div class="col-md-4">
                        <p class=" text-center" style="font-weight:bold">
                            Status:
                                <span style="font-weight:normal">
                                    <?php if ($planning->status == 'Accepté') {
                                    	echo '<b class="text-success">Accepté</b>';
                                    } elseif ($planning->status == 'Refusé') {
                                    	echo '<b class="text-danger">Refusé</b>';
                                    } else {
                                    	echo '<b>En attente</b>';
                                    } ?>
                                </span>
                        </p>
                    </div>

                    <div class="col-md-4">

                        <!--Delete-->
                        <form action="<?php echo URLROOT; ?>/plannings/deleteEffective/<?php echo $planning->id_planning_effectif; ?>/0"
                              method="post" onclick="return confirm('Voulez-vous supprimer ce planning ?')">
                            <button type="submit" class="btn btn-danger pull-right ml-2"
                                <?php echo $planning->status == "Accepté"
                                	? "disabled='disabled'"
                                	: ""; ?>>
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>

                        <!--edit-->
                        <form action="<?php echo URLROOT ."/plannings/editEffective/".$planning->id_planning_effectif."/0"; ?>">
                            <button type="submit" class="btn btn-primary pull-right ml-2"
                                <?php echo $planning->status == "Accepté"
                                	? "disabled='disabled'"
                                	: ""; ?>>
                                <i class="fa fa-edit"></i>
                            </button>
                        </form>


                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

<?php
else:
	 ?>
    <div class="text-center mb-3">
        <h1>Pas d'heures éffectives pour cette semaine !</h1>
        <img src="<?php echo URLROOT; ?>/images/img1.png" class="img-fluid" alt="Responsive image" width="700">
    </div>
<?php
endif; ?>
