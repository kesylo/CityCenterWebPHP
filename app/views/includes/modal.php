<a data-toggle="modal" class="card-link <?php echo
    $d["status"] == "Accepté" ? ("text-success") :
    ($d["status"] == "Refusé" ? ("text-danger") : ("")) ?>"
   href="#" data-target="#myModal<?php echo $d['id'] ?>">

    <?php echo $d["time"]?>
</a>