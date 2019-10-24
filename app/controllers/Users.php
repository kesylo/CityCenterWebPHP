<?php
class Users extends Controller {

    /**
     * Users constructor.
     */
    public function __construct()
    {
        // load a model
        $this->userModel = $this->model('User');
    }

    public function createUserSession($user){
        $_SESSION['id'] = $user->id;
        $_SESSION['email'] = $user->email;
        $_SESSION['firstName'] = $user->firstName;
        $_SESSION['lastName'] = $user->lastName;

        redirect('plannings/dashboard');
    }

    public function logout(){
        // just delete session variables
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);

        session_destroy();

        redirect('users/login');
    }


    public function login(){    // check if post

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

            // load the about page
            $this->view('users/login', $data);
        }
    }
}
