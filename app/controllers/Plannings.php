<?php

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

        if (isset($_SESSION['id']) && $_SESSION['role'] > 4){
            $data = [
                'plannings' => '',
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

}
