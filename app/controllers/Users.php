<?php
class Users extends Controller {

    /**
     * Users constructor.
     */
    public function __construct()
    {

    }

    public function login(){
        // check if post
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // process form
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
