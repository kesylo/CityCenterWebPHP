<?php
class Users extends Controller
{
	/**
	 * Users constructor.
	 */
	public function __construct()
	{
		// load a model
		$this->userModel = $this->model('User');
	}

	public function createUserSession($user)
	{
		$_SESSION['id'] = $user->id;
		$_SESSION['email'] = $user->email;
		$_SESSION['pseudo'] = $user->pseudo;
		$_SESSION['firstName'] = $user->firstName;
		$_SESSION['lastName'] = $user->lastName;
		$_SESSION['role'] = $user->role;

		// create Base cookies for dates
		$currentDay = date('d-m-Y', strtotime('monday this week'));
		setcookie("weekUser", $currentDay, time() + 86400 * 30, "/");
		setcookie("weekAdmin", $currentDay, time() + 86400 * 30, "/");

		if ($user->role > 3) {
			redirect('plannings/admin');
		} else {
			redirect('plannings/dashboard');
		}
	}

	public function logout()
	{
		// just delete session variables
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['pseudo']);
		unset($_SESSION['firstName']);
		unset($_SESSION['lastName']);
		unset($_SESSION['role']);

		session_destroy();

		//destroy cookies
		setcookie("weekUser", "", time() + 86400 * 30, "/");
		setcookie("selectedTab", "", time() + 86400 * 30, "/");
		setcookie("weekAdmin", "", time() + 86400 * 30, "/");
		setcookie("PHPSESSID", "", time() + 86400 * 30, "/");
		setcookie("dayBulk", "", time() + 86400 * 30, "/");
		setcookie("idSelectedUser", "", time() + 86400 * 30, "/");
		setcookie("scroll", "", time() + 86400 * 30, "/");
		setcookie("weekBulk", "", time() + 86400 * 30, "/");

		redirect('users/login');
	}

	/*public function login(){    // check if post

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // make sure text field are clean
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // validate email
            if (empty($data['email'])){
                $data['email_err'] = 'Entrez une adresse email valide.';
            }

            // validate password
            if (empty($data['password'])){
                $data['password_err'] = 'Entrez un mot de  passe valide.';
            }

            // check if email & password combination exist
            if ($this->userModel->findUsersByEmail($data['email'])){
                // user found
            } else{
                // user not found
                $data['email_err'] = "Cet utilisateur n'existe pas";
            }

            // make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])){
                // validation Ok
                // check and set login user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser){
                    // create session variable
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_err'] = "Mot de passe incorrect";
                    // reload the view
                    $this->view('users/login', $data);
                }
            }else {
                // load view with errors
                $this->view('users/login', $data);
            }

        } else{
            // init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            $this->view('users/login', $data);
        }
    }*/

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// make sure text field are clean
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			// init data
			$data = [
				'pseudo' => trim($_POST['pseudo']),
				'password' => trim($_POST['password']),
				'pseudo_err' => '',
				'password_err' => ''
			];

			// validate email
			if (empty($data['pseudo'])) {
				$data['pseudo'] = 'Entrez un pseudo valide.';
			}

			// validate password
			if (empty($data['password'])) {
				$data['password_err'] = 'Entrez un mot de  passe valide.';
			}

			// check if email & password combination exist
			if ($this->userModel->findUsersByPseudo($data['pseudo'])) {
				// user found
			} else {
				// user not found
				$data['pseudo_err'] = "Cet utilisateur n'existe pas";
			}

			// make sure errors are empty
			if (empty($data['pseudo_err']) && empty($data['password_err'])) {
				// validation Ok
				// check and set login user
				$loggedInUser = $this->userModel->login($data['pseudo'], $data['password']);

				if ($loggedInUser) {
					// create session variable
					$this->createUserSession($loggedInUser);
				} else {
					$data['password_err'] = "Mot de passe incorrect";
					// reload the view
					$this->view('users/login', $data);
				}
			} else {
				// load view with errors
				$this->view('users/login', $data);
			}
		} else {
			// init data
			$data = [
				'pseudo' => '',
				'password' => '',
				'email_err' => '',
				'password_err' => ''
			];

			$this->view('users/login', $data);
		}
	}
}
