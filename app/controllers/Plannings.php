<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include APPROOT . "/views/session.php";

class Plannings extends Controller
{
	private $planningModel;

	/**
	 * Plannings constructor.
	 */
	public function __construct()
	{
		// make sure it's accessed only when connected
		if (!isLoggedIn()) {
			redirect('users/login');
		}

		$this->planningModel = $this->model('Planning');
	}

	public function cmp($a, $b)
	{
		return strcmp($a->firstName, $b->firstName);
	}

	public function index()
	{
		$plannings = $this->planningModel->getUserPlannings(
			$_SESSION['id'],
			$_COOKIE["weekUser"]
		);

		// for table
		$allPlannings = $this->planningModel->getAllUsersPlannings(
			$_COOKIE["weekUser"]
		);

		$newList = $this->planningModel->getAllActiveUsers();

		$bo = array();
		$fo = array();
		$hk = array();
		$mt = array();

		foreach ($newList as $user) {
			if ($user->dept == "Back Office") {
				array_push($bo, $user);
			}
			if ($user->dept == "House Keeping") {
				array_push($hk, $user);
			}
			if ($user->dept == "Maintenance") {
				array_push($mt, $user);
			}
			if ($user->dept == "Front Office") {
				array_push($fo, $user);
			}
		}

		usort($bo, array($this, "cmp"));
		usort($hk, array($this, "cmp"));
		usort($mt, array($this, "cmp"));
		usort($fo, array($this, "cmp"));

		$usersList = array();

		foreach ($bo as $b) {
			array_push($usersList, $b);
		}
		foreach ($hk as $b) {
			array_push($usersList, $b);
		}
		foreach ($mt as $b) {
			array_push($usersList, $b);
		}
		foreach ($fo as $b) {
			array_push($usersList, $b);
		}

		$planningsEffective = $this->planningModel->getUserPlanningsEffective(
			$_SESSION['id'],
			$_COOKIE["weekUser"]
		);

		$data = [
			'plannings' => $plannings,
			'$allPlannings' => $allPlannings,
			'planningsEffective' => $planningsEffective,
			'users' => $usersList
		];

		$this->view('plannings/dashboard', $data);
	}

	public function edit($id_planning, $admin)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'id' => $_SESSION['id'],
				'id_planning' => $id_planning,
				'week' => trim($_POST['week']),
				'date' => trim($_POST['date']),
				'startTime' => trim($_POST['startTime']),
				'endTime' => trim($_POST['endTime']),
				'status' => trim($_POST['status']),
				'callRedirect' => trim($_POST['callRedirect']),
				'timeStart_err' => '',
				'timeEnd_err' => '',
				'date_err' => ''
			];

			// validate
			if (empty($data['startTime'])) {
				$data['timeStart_err'] = 'Entrez une heure de debut';
			}
			if (empty($data['endTime'])) {
				$data['timeEnd_err'] = 'Entrez une heure de fin';
			}
			if (empty($data['date'])) {
				$data['date_err'] = 'Entrez une date';
			}

			if (
				empty($data['timeStart_err']) &&
				empty($data['timeEnd_err']) &&
				empty($data['date_err'])
			) {
				// validated
				if ($this->planningModel->updatePlanning($data)) {
					// show flash message
					flash('planning_message', "Votre planning a été Modifié!");
					if ($admin == 1) {
						redirect('plannings/admin');
					} else {
						redirect('plannings/dashboard');
					}
				} else {
					die('err');
				}
			} else {
				$this->view('plannings/edit', $data);
			}
		} else {
			// fectch planning
			$planning = $this->planningModel->getPlanningById($id_planning);

			/*if ($planning->id_user != $_SESSION['id']){
                redirect('plannings');
            }*/

			$data = [
				'id_planning' => $id_planning,
				'week' => $planning->week,
				'date' => $planning->date,
				'startTime' => $planning->startTime,
				'endTime' => $planning->endTime,
				'status' => $planning->status,
				'callRedirect' => $planning->callRedirect,
				'id_user' => $planning->id_user,
				'admin' => $admin
			];

			$this->view('plannings/edit', $data);
		}
	}

	public function editEffective($id_planning, $admin)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
				'date_err' => ''
			];

			// validate
			if (empty($data['startTime'])) {
				$data['timeStart_err'] = 'Entrez une heure de debut';
			}
			if (empty($data['endTime'])) {
				$data['timeEnd_err'] = 'Entrez une heure de fin';
			}
			if (empty($data['date'])) {
				$data['date_err'] = 'Entrez une date';
			}

			if (
				empty($data['timeStart_err']) &&
				empty($data['timeEnd_err']) &&
				empty($data['date_err'])
			) {
				// validated
				if ($this->planningModel->updatePlanningEffective($data)) {
					// show flash message
					flash('planning_message', "Heure éffective Modifiée!");
					if ($admin == 1) {
						redirect('plannings/admin');
					} else {
						redirect('plannings/dashboard');
					}
				} else {
					die('err');
				}
			} else {
				$this->view('plannings/editEffective', $data);
			}
		} else {
			// fetch planning
			$planning = $this->planningModel->getPlanningEffectiveById($id_planning);

			$data = [
				'id_planning' => $id_planning,
				'week' => $planning->week,
				'date' => $planning->date,
				'startTime' => $planning->startTime,
				'endTime' => $planning->endTime,
				'status' => $planning->status,
				'callRedirect' => $planning->callRedirect,
				'id_user' => $planning->id_user,
				'admin' => $admin
			];

			$this->view('plannings/editEffective', $data);
		}
	}

	public function editExtra($id_planning)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'id' => $_SESSION['id'],
				'id_planning' => $id_planning,
				'week' => trim($_POST['week']),
				'date' => trim($_POST['date']),
				'startTime' => trim($_POST['startTime']),
				'endTime' => trim($_POST['endTime']),
				'status' => 'Accepté',
				'callRedirect' => trim($_POST['callRedirect']),
				'timeStart_err' => '',
				'timeEnd_err' => '',
				'date_err' => ''
			];

			// validate
			if (empty($data['startTime'])) {
				$data['timeStart_err'] = 'Entrez une heure de debut';
			}
			if (empty($data['endTime'])) {
				$data['timeEnd_err'] = 'Entrez une heure de fin';
			}
			if (empty($data['date'])) {
				$data['date_err'] = 'Entrez une date';
			}

			if (
				empty($data['timeStart_err']) &&
				empty($data['timeEnd_err']) &&
				empty($data['date_err'])
			) {
				// validated
				if ($this->planningModel->updatePlanning($data)) {
					// show flash message
					flash('planning_message', "Votre Extra a été Cloturé!");
					redirect('plannings/dashboard');
				} else {
					die('err');
				}
			} else {
				$this->view('plannings/editExtra', $data);
			}
		} else {
			// fectch planning
			$planning = $this->planningModel->getPlanningById($id_planning);

			if ($planning->id_user != $_SESSION['id']) {
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
				'id_user' => $planning->id_user
			];

			$this->view('plannings/editExtra', $data);
		}
	}

	public function admin()
	{

		if (isset($_SESSION['id']) && $_SESSION['role'] > 3) {
			$plannings = $this->planningModel->getAllUsersPlannings(
				$_COOKIE["weekAdmin"]
			);

			$newList = $this->planningModel->getAllActiveUsers();

			$bo = array();
			$fo = array();
			$hk = array();
			$mt = array();

			foreach ($newList as $user) {
				if ($user->dept == "Back Office") {
					array_push($bo, $user);
				}
				if ($user->dept == "House Keeping") {
					array_push($hk, $user);
				}
				if ($user->dept == "Maintenance") {
					array_push($mt, $user);
				}
				if ($user->dept == "Front Office") {
					array_push($fo, $user);
				}
			}

			usort($bo, array($this, "cmp"));
			usort($hk, array($this, "cmp"));
			usort($mt, array($this, "cmp"));
			usort($fo, array($this, "cmp"));

			$usersList = array();

			foreach ($bo as $b) {
				array_push($usersList, $b);
			}
			foreach ($hk as $b) {
				array_push($usersList, $b);
			}
			foreach ($mt as $b) {
				array_push($usersList, $b);
			}
			foreach ($fo as $b) {
				array_push($usersList, $b);
			}

			$data = [
				'plannings' => $plannings,
				'users' => $usersList
			];

			$this->view('plannings/admin', $data);
		} else {
			redirect('plannings/dashboard');
			flashError(
				'planning_message',
				"Désolé vous ne pouvez pas passer en mode administrateur!"
			);
		}
	}

	public function add()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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
				'date_err' => ''
			];

			// validate
			if (empty($data['startTime'])) {
				$data['timeStart_err'] = 'Entrez une heure de debut';
			}
			if (empty($data['endTime'])) {
				$data['timeEnd_err'] = 'Entrez une heure de fin';
			}
			if (empty($data['date'])) {
				$data['date_err'] = 'Entrez une date';
			}

			if (
				empty($data['timeStart_err']) &&
				empty($data['timeEnd_err']) &&
				empty($data['date_err'])
			) {
				if (
					preg_match("/\d{2}\-\d{2}-\d{4}/", $data["week"]) &&
					preg_match("/\d{2}\-\d{2}-\d{4}/", $data["date"])
				) {
					// validated
					if ($this->planningModel->addPlanning($data)) {
						// show flash message
						flash('planning_message', "Votre planning a été ajouté!");
						redirect('plannings/dashboard');
					} else {
						die('errr');
					}
				} else {
					flashError(
						'planning_message',
						"Erreur lors de l'ajout. Les dates entrées ne sont pas au bon format"
					);
					redirect('plannings/dashboard');
				}
			} else {
				$this->view('plannings/add', $data);
			}
		} else {
			$data = [
				'week' => '',
				'date' => ''
			];

			$this->view('plannings/add', $data);
		}
	}

	public function addEffective()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$week = date('d-m-Y', strtotime('monday this week'));
			$day = date('d-m-Y', strtotime('today'));

			$data = [
				'id' => $_SESSION['id'],
				'week' => $week,
				'date' => $day,
				'startTime' => trim($_POST['startTime']),
				'endTime' => trim($_POST['endTime']),
				'status' => 'En attente',
				'callRedirect' => trim($_POST['callRedirect']),
				'timeStart_err' => '',
				'timeEnd_err' => '',
				'date_err' => ''
			];

			// validate
			if (empty($data['startTime'])) {
				$data['timeStart_err'] = 'Entrez une heure de debut';
			}
			if (empty($data['endTime'])) {
				$data['timeEnd_err'] = 'Entrez une heure de fin';
			}
			if (empty($data['date'])) {
				$data['date_err'] = 'Entrez une date';
			}

			if (
				empty($data['timeStart_err']) &&
				empty($data['timeEnd_err']) &&
				empty($data['date_err'])
			) {
				if (
					preg_match("/\d{2}\-\d{2}-\d{4}/", $data["week"]) &&
					preg_match("/\d{2}\-\d{2}-\d{4}/", $data["date"])
				) {
					// validated
					if ($this->planningModel->addEffective($data)) {
						// show flash message
						flash('planning_message', "Heure éffective ajoutée!");
						redirect('plannings/dashboard');
					} else {
						die('errr');
					}
				} else {
					flashError(
						'planning_message',
						"Erreur lors de l'ajout. Les dates entrées ne sont pas au bon format"
					);
					redirect('plannings/dashboard');
				}
			} else {
				$this->view('plannings/addEffective', $data);
			}
		} else {
			$data = [
				'week' => '',
				'date' => ''
			];

			$this->view('plannings/addEffective', $data);
		}
	}

	public function bulkAdd()
	{
		$users = $this->planningModel->getUserNameAndID();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'names' => trim($_POST['idBulk']),
				'week' => trim($_POST['week']),
				'date' => trim($_POST['date']),
				'startTime' => trim($_POST['startTime']),
				'endTime' => trim($_POST['endTime']),
				'details' => trim($_POST['details']),
				'status' => 'En attente',
				'callRedirect' => trim($_POST['callRedirect']),
				'timeStart_err' => '',
				'timeEnd_err' => '',
				'date_err' => ''
			];

			// validate
			if (empty($data['startTime'])) {
				$data['timeStart_err'] = 'Entrez une heure de debut';
			}
			if (empty($data['endTime'])) {
				$data['timeEnd_err'] = 'Entrez une heure de fin';
			}
			if (empty($data['date'])) {
				$data['date_err'] = 'Entrez une date';
			}

			if (
				empty($data['timeStart_err']) &&
				empty($data['timeEnd_err']) &&
				empty($data['date_err'])
			) {
				// get ID by name
				$selectText = $data['names'];

				foreach ($users as $user) {
					$fullName = $user->firstName . " " . $user->lastName;
					/*if (preg_match("/$fullName/", $selectText) == true)
                    {
                        //echo ($user->id);
                        $data['names'] = $user->id;
                    }*/

					similar_text($fullName, $selectText, $similarity);

					//echo nl2br("string " . $fullName . " and ". $selectText . " similarity is ". $similarity . "\n");

					if ($similarity >= 85) {
						//echo ($user->id);
						$data['names'] = $user->id;
					}
				}

				// validated
				if ($this->planningModel->bulkAdd($data)) {
					// show flash message
					flash(
						'planning_message',
						"La disponibilité de " . strtoupper($selectText) . " a été ajoutée!"
					);
					redirect('plannings/bulkAdd');
				} else {
					die('errr');
				}
			} else {
				$this->viewBulk('plannings/bulkAdd', $data, $users);
			}
		} else {
			$data = [
				'week' => '',
				'date' => ''
			];
			$this->viewBulk('plannings/bulkAdd', $data, $users);
		}
	}

	public function addExtra()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'id' => $_SESSION['id'],
				'week' => trim($_POST['week']),
				'date' => trim($_POST['date']),
				'startTime' => trim($_POST['startTime']),
				'endTime' => '',
				'status' => 'En attente',
				'callRedirect' => trim($_POST['callRedirect']),
				'timeStart_err' => '',
				'timeEnd_err' => '',
				'date_err' => ''
			];

			// validate
			if (empty($data['startTime'])) {
				$data['timeStart_err'] = 'Entrez une heure de debut';
			}
			if (empty($data['date'])) {
				$data['date_err'] = 'Entrez une date';
			}

			if (
				empty($data['timeStart_err']) &&
				empty($data['timeEnd_err']) &&
				empty($data['date_err'])
			) {
				if (
					preg_match("/\d{2}\-\d{2}-\d{4}/", $data["week"]) &&
					preg_match("/\d{2}\-\d{2}-\d{4}/", $data["date"])
				) {
					// validated
					if ($this->planningModel->addExtra($data)) {
						// show flash message
						flash('planning_message', "Votre Extra a été ajouté!");
						redirect('plannings/dashboard');
					} else {
						die('errr');
					}
				} else {
					flashError(
						'planning_message',
						"Erreur lors de l'ajout. Les dates entrées ne sont pas au bon format"
					);
					redirect('plannings/dashboard');
				}
			} else {
				$this->view('plannings/addExtra', $data);
			}
		} else {
			$data = [
				'week' => '',
				'date' => ''
			];

			$this->view('plannings/addExtra', $data);
		}
	}

	public function delete($id_planning, $admin)
	{

        if ($this->planningModel->deletePlanning($id_planning)) {
            flash('post_message', 'Votre planning a été supprimé!');
            if ($admin == 1) {
                redirect('plannings/admin');
            } else {
                redirect('plannings/dashboard');
            }
        } else {
            die("error deleting");
        }

        if ($admin == 1) {
            redirect('plannings/admin');
        } else {
            redirect('plannings/dashboard');
        }
	}

	public function deleteEffective($id_planning, $admin)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->planningModel->deletePlanningEffective($id_planning)) {
				flash('post_message', 'Heure éffective supprimée!');
				if ($admin == 1) {
					redirect('plannings/admin');
				} else {
					redirect('plannings/dashboard');
				}
			} else {
				die("error deleting");
			}
		} else {
			if ($admin == 1) {
				redirect('plannings/admin');
			} else {
				redirect('plannings/dashboard');
			}
		}
	}

	public function deny($id_planning, $email)
	{
        if ($this->planningModel->denyPlanning($id_planning)) {
            flashError(
                'planning_message',
                'Le planning a été refusé! Un email a été envoyé a ' . $email
            );

            // get the planning details to send via mail
            $planning = $this->planningModel->getPlanningById($id_planning);

            //region Email
            $subject = utf8_decode('Planning du ' . $planning->date . ' refusé!');
            $body = utf8_decode(
                'Semaine du: ' .
                $planning->week .
                ' <br> Heure de début: ' .
                $planning->startTime .
                ' <br> Heure de fin: ' .
                $planning->endTime .
                ' <br> Rédirection des appels: ' .
                $planning->callRedirect .
                ' <br> Status: ' .
                $planning->status
            );

            $mail = new PHPMailer(true);
            try {
                //$mail->isSMTP();                                            // Send using SMTP
                $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'test4cash.1@gmail.com'; // SMTP username
                $mail->Password = 'Azerty.1994'; // SMTP password
                $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port = 465; // TCP port to connect to

                //Recipients
                $mail->setFrom('test4cash.1@gmail.com', 'City Center Planner');
                $mail->addAddress($email); // Add a recipient

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AltBody = $body;

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            //endregion*/

            redirect('plannings/admin');
        } else {
            die("error deny");
        }
	}

	public function accept($id_planning, $email)
	{
		/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		} else {
			redirect('plannings/admin');
		}*/

        if ($this->planningModel->acceptPlanning($id_planning)) {
            flash(
                'planning_message',
                'Le planning a été accepté! Un email a été envoyé a ' . $email
            );

            // get the planning details to send via mail
            $planning = $this->planningModel->getPlanningById($id_planning);

            //region Email
            $subject = utf8_decode('Planning du ' . $planning->date . ' accepté!');
            $body = utf8_decode(
                'Semaine du: ' .
                $planning->week .
                ' <br> Heure de début: ' .
                $planning->startTime .
                ' <br> Heure de fin: ' .
                $planning->endTime .
                ' <br> Rédirection des appels: ' .
                $planning->callRedirect .
                ' <br> Status: ' .
                $planning->status
            );

            $mail = new PHPMailer(true);
            try {
                //$mail->isSMTP();  // do not use this on some hosting servers. eg: SiteGroung and hostinger
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'test4cash.1@gmail.com';
                $mail->Password = 'Azerty.1994';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                //Recipients
                $mail->setFrom('test4cash.1@gmail.com', 'City Center Planner');
                $mail->addAddress($email); // Add a recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AltBody = $body;

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            //endregion*/

            redirect('plannings/admin');
        } else {
            die("error accept");
        }
	}
}
