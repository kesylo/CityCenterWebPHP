<?php
function displayUserPlanning($id, $data, $choice)
{
    //region Variables
    $values = array();

    $monday = "Mon";
    $tuesday = "Tue";
    $wednesday = "Wed";
    $thursday = "Thu";
    $friday = "Fri";
    $saturday = "Sat";
    $sunday = "Sun";

    //endregion

    foreach ($data['plannings'] as $index => $planning) {

        if ($planning->id_user == $id) {
            if ($planning->week == $_COOKIE["nextWeekDate"]) {

                $date = $planning->date;
                $nameOfDay = date('D', strtotime($date));

                //region choices

                if ($choice == $monday) {
                    if ($nameOfDay == $monday) {
                        $values = array(
                                "mon" => array(
                                        "time" => $planning->startTime . " - " . $planning->endTime,
                                        "status" => $planning->status,
                                        "id" => $planning->id_planning
                                )
                        );
                    }
                }

                if ($choice == $tuesday) {
                    if ($nameOfDay == $tuesday) {
                        array_push($values, "TUE");
                    }
                }

                if ($choice == $wednesday) {
                    if ($nameOfDay == $wednesday) {
                        array_push($values, "WED");
                    }
                }

                //endregion

            }
        }
    }


    return $values;
}
?>

<!-- table Heading -->
<div class="card" style="max-height: 50px; overflow: auto; display: block;">
    <div class="table-responsive" >
        <table class="table table-bordered table-hover ">
            <thead class="thead-dark">
            <?php
            $d = strtotime($_COOKIE["nextWeekDate"]);
            $date = date('d-m-Y', $d);
            ?>
            <tr>
                <th scope="col" style="width: 15%">Noms</th>
                <th scope="col" style="width: 7%">Dépt</th>
                <th scope="col" style="width: 11.14%">
                    Lundi
                    <?php echo date('d', strtotime($date . ' +0 day')); ?>
                </th>
                <th scope="col" style="width: 11.14%">
                    Mardi
                    <?php echo date('d', strtotime($date . ' +1 day')); ?>
                </th>
                <th scope="col" style="width: 11.14%">
                    Mercredi
                    <?php echo date('d', strtotime($date . ' +2 day')); ?>
                </th>
                <th scope="col" style="width: 11.14%">
                    Jeudi
                    <?php echo date('d', strtotime($date . ' +3 day')); ?>
                </th>
                <th scope="col" style="width: 11.14%">
                    Vendredi
                    <?php echo date('d', strtotime($date . ' +4 day')); ?>
                </th>
                <th scope="col" style="width: 11.14%">
                    Samedi
                    <?php echo date('d', strtotime($date . ' +5 day')); ?>
                </th>
                <th scope="col" style="width: 11.14%">
                    Dimache
                    <?php echo date('d', strtotime($date . ' +6 day')); ?>
                </th>
            </tr>
            </thead>
        </table>
    </div>
</div>



<div class="card" style="max-height: 600px; overflow: auto; display: block;">
    <div class="table-responsive" >
        <table class="table table-bordered">
            <tbody>

            <?php
            foreach ($data['users'] as $user) : ?>

                <tr>
                    <!-- Show users names-->
                    <th class="align-middle" scope="row" style="width: 15%">
                        <?php
                            $name = strtoupper($user->firstName) . " "
                            . ucfirst(mb_strtolower($user->lastName, 'UTF-8'));

                            echo $name;
                        ?>
                    </th>

                    <!-- Show users dept-->
                    <td class="align-middle" style="width: 7%">
                        <?php
                        $words = explode(" ", $user->dept);
                        $dept = "";
                        if (count($words) == 2) {
                            foreach ($words as $w) {
                                // show first Letter of each word
                                $dept .= $w[0];
                            }
                        } else {
                            foreach ($words as $w) {
                                // show the 2 first letters of the word
                                $dept .= $w[0];
                                $dept .= strtoupper($w[1]);
                            }
                        }
                        echo $dept;
                        ?>
                    </td>

                    <!-- Show users plannings Monday -->
                    <td class="align-middle" style="width: 11.14%">
                        <?php
                        $days = displayUserPlanning($user->id, $data, "Mon");
                        foreach ($days as $d) : ?>

                            <?php require APPROOT . '/views/includes/modal.php'; ?>

                        <?php endforeach; ?>
                    </td>

                    <!-- Show users plannings Tuesday -->
                    <td class="align-middle" style="width: 11.14%">
                        <?php
                        $days = displayUserPlanning($user->id, $data, "Tue");
                        foreach ($days as $d) {
                            echo $d . "<br>";
                        }
                        ?>
                    </td>

                    <!-- Show users plannings Wednesday -->
                    <td class="align-middle" style="width: 11.14%">
                        <?php
                        $days = displayUserPlanning($user->id, $data, "Wed");
                        foreach ($days as $d) {
                            echo $d . "<br>";
                        }
                        ?>
                    </td>

                    <td>fdgdg</td>
                    <td>fdgdg</td>
                    <td>fdgdg</td>
                    <td>fdgdg</td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>





<script>


    /*$(document).ready(function(){

        $(document).on('click', '.view_data', function()
        {
            // get data
            let id_planning = $(this).attr('id');

            console.log("fdsfd    " + id_planning);

            // run query to find plannings from id
            $.ajax({
                url: "query.php",
                method: "post",
                data:{id_planning:id_planning}, // data to send
                success:function (data) { // if success store data result
                    // now print received data
                    $('#planning_detail').html(data);
                    $('#dataModal').modal("show");
                }
            });
        });

    });*/
</script>

