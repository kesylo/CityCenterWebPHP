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
                        array_push($values, $planning->startTime . " - " . $planning->endTime);
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


<div class="card" style="max-height: 600px; overflow: auto; display: block;">
    <div class="table-responsive" >
        <table class="table table-bordered table-hover ">
            <thead class="thead-dark">
            <?php
            $d = strtotime($_COOKIE["nextWeekDate"]);
            $date = date('d-m-Y', $d);
            ?>
            <tr>
                <th scope="col" style="width: 15%">Noms</th>
                <th scope="col" style="width: 5%">Dépt</th>
                <th scope="col" style="width: 10%">
                    Lundi
                    <?php echo date('d', strtotime($date . ' +0 day')); ?>
                </th>
                <th scope="col" style="width: 10%">
                    Mardi
                    <?php echo date('d', strtotime($date . ' +1 day')); ?>
                </th>
                <th scope="col" style="width: 10%">
                    Mercredi
                    <?php echo date('d', strtotime($date . ' +2 day')); ?>
                </th>
                <th scope="col" style="width: 10%">
                    Jeudi
                    <?php echo date('d', strtotime($date . ' +3 day')); ?>
                </th>
                <th scope="col" style="width: 10%">
                    Vendredi
                    <?php echo date('d', strtotime($date . ' +4 day')); ?>
                </th>
                <th scope="col" style="width: 10%">
                    Samedi
                    <?php echo date('d', strtotime($date . ' +5 day')); ?>
                </th>
                <th scope="col" style="width: 10%">
                    Dimache
                    <?php echo date('d', strtotime($date . ' +6 day')); ?>
                </th>
            </tr>
            </thead>

            <tbody>

                <?php
                foreach ($data['users'] as $user) : ?>

                    <tr>
                        <!-- Show users names-->
                        <th class="pr-0 align-middle" scope="row">
                            <?php echo strtoupper($user->firstName[0]) . ". "
                                . ucfirst(mb_strtolower($user->lastName, 'UTF-8')) ?>
                        </th>

                        <!-- Show users dept-->
                        <td class="align-middle pr-0">
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
                        <td class="align-middle pr-0">
                            <?php
                            $days = displayUserPlanning($user->id, $data, "Mon");
                            foreach ($days as $d) {
                                echo $d . "<br>";
                            }
                            ?>
                        </td>

                        <!-- Show users plannings Tuesday -->
                        <td>
                            <?php
                            $days = displayUserPlanning($user->id, $data, "Tue");
                            foreach ($days as $d) {
                                echo $d . "<br>";
                            }
                            ?>
                        </td>

                        <!-- Show users plannings Wednesday -->
                        <td>
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

