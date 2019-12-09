<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class Plannings extends Controller{


    /**
     * Plannings constructor.
     */
    public function __construct()
    {
        // make sure it's accessed only when connected
        if (!isLoggedIn()){
            redirect('users/login');
        }

        $this->planningModel = $this->model('Planning');
    }

    public function index(){
        $plannings = $this->planningModel->getUserPlannings($_SESSION['id'], $_COOKIE["nextWeekDate"]);

        $data = [
            'plannings' => $plannings,
        ];

        $this->view('plannings/dashboard', $data);
    }

    public function edit($id_planning){

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'id' => $_SESSION['id'],
                'id_planning' => $id_planning,
                'week' => trim($_POST['week']),
                'date' => trim($_POST['date']),
                'startTime' => trim($_POST['startTime']),
                'endTime' => trim($_POST['endTime']),
                'status' => 'En attente',
                'callRedirect' => trim($_POST['callRedirect']),
                'timeStart_err' => '',
                'timeEnd_err' => '',
                'date_err' => '',
            ];

            // validate
            if (empty($data['startTime'])){
                $data['timeStart_err'] = 'Entrez une heure de debut';
            }
            if (empty($data['endTime'])){
                $data['timeEnd_err'] = 'Entrez une heure de fin';
            }
            if (empty($data['date'])){
                $data['date_err'] = 'Entrez une date';
            }

            if (empty($data['timeStart_err']) && empty($data['timeEnd_err']) && empty($data['date_err'])){
                // validated
                if ($this->planningModel->updatePlanning($data)){
                    // show flash message
                    flash('planning_message', "Votre planning a été Modifié!");
                    redirect('plannings/dashboard');
                }else{
                    die('errr');
                }
            }else{
                $this->view('plannings/edit', $data);
            }


        }else{
            // fectch planning
            $planning = $this->planningModel->getPlanningById($id_planning);

            if ($planning->id_user != $_SESSION['id']){
                redirect('plannings');
            }

            $data = [
                'id_planning' => $id_planning,
                'week' => $planning->week,
                'date' => $planning->date,
                'startTime' => $planning->startTime,
                'endTime' => $planning->endTime,
                'status' => $planning->status,
                'callRedirect' => $planning->callRedirect,
                'id_user' => $planning->id_user,
            ];

            $this->view('plannings/edit', $data);
        }
    }

    public function admin(){

        //if ($_SESSION['waiting'] == 'all'){
        //}

        if (isset($_SESSION['id']) && $_SESSION['role'] > 4){

            $plannings = $this->planningModel->getAllUsersPlannings($_COOKIE["nextWeekDate"]);

            $ids = array();
            $users = array();
            $names = array();

            // store all user ids who created a planning
            foreach ($plannings as $key=>$pl){
                $ids[$key] = $pl->id_user;
            }

            // remove duplicates
            $uniqueIds = array_unique($ids);

            // trim names only and store
            foreach ($uniqueIds as $key=>$id){
                $users[$uniqueIds[$key]] = $this->planningModel->getUserById($uniqueIds[$key]);
                $names[$uniqueIds[$key]] = $users[$uniqueIds[$key]]->firstName . ' ' . $users[$uniqueIds[$key]]->lastName;
            }

            $data = [
                'plannings' => $plannings,
                'unique' => $names,
            ];

            $this->view('plannings/admin', $data);
        }else{
            redirect('plannings/dashboard');
            flashError('planning_message', "Désolé vous ne pouvez pas passer en mode administrateur!");
        }




    }

    public function add(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // covert dates to french
            /*$week = UStoFRDate(trim($_POST['week']));
            $date = UStoFRDate(trim($_POST['date']));*/

            $data = [
                'id' => $_SESSION['id'],
                'week' => trim($_POST['week']),
                'date' => trim($_POST['date']),
                'startTime' => trim($_POST['startTime']),
                'endTime' => trim($_POST['endTime']),
                'status' => 'En attente',
                'callRedirect' => trim($_POST['callRedirect']),
                'timeStart_err' => '',
                'timeEnd_err' => '',
                'date_err' => '',
            ];

            // validate
            if (empty($data['startTime'])){
                $data['timeStart_err'] = 'Entrez une heure de debut';
            }
            if (empty($data['endTime'])){
                $data['timeEnd_err'] = 'Entrez une heure de fin';
            }
            if (empty($data['date'])){
                $data['date_err'] = 'Entrez une date';
            }

            if (empty($data['timeStart_err']) && empty($data['timeEnd_err']) && empty($data['date_err'])){
                // validated
                if ($this->planningModel->addPlanning($data)){
                    // show flash message
                    flash('planning_message', "Votre planning a été ajouté!");
                    redirect('plannings/dashboard');
                }else{
                    die('errr');
                }
            }else{
                $this->view('plannings/add', $data);
            }


        }else{
            $data = [
                'week' => '',
                'date' => '',
            ];

            $this->view('plannings/add', $data);
        }
    }

    public function delete($id_planning){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if ($this->planningModel->deletePlanning($id_planning)){
                flash('post_message', 'Votre planning a été supprimé!');
                redirect('plannings');
            }else{
                die("error deleting");
            }
        } else {
            redirect('plannings');
        }
    }

    public function deny($id_planning){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if ($this->planningModel->denyPlanning($id_planning)){
                flashError('planning_message', 'Le planning a été refusé!');
                redirect('plannings/admin');
            }else{
                die("error deny");
            }
        } else {
            redirect('plannings/admin');
        }
    }

    public function accept($id_planning){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if ($this->planningModel->acceptPlanning($id_planning)){
                flash('planning_message', 'Le planning a été accepté!');

                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'test4cash.1@gmail.com';                     // SMTP username
                    $mail->Password   = 'Azerty.1994';                               // SMTP password
                    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                    $mail->Port       = 465;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('test4cash.1@gmail.com', 'City Center Planner');
                    $mail->addAddress('keming.loic@yahoo.com');     // Add a recipient

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }


                redirect('plannings/admin');
            }else{
                die("error accept");
            }
        } else {
            redirect('plannings/admin');
        }
    }

}