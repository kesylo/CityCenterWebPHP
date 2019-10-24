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
            } else {
                if (!$this->userModel->findUsersByEmail($data['email'])){
                    $data['email_err'] = "Cette adresse email n'existe pas";
                }
            }

            // validate password
            if (empty($data['password'])){
                $data['password_err'] = 'Entrez un mot de  passe valide.';
            }

            // make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])){
                // validation Ok
                // display flash message
                flash('login_success', 'you are connected');
                die('success');
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
