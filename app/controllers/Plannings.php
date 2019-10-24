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
    }

    public function index(){
        $data = [];

        $this->view('plannings/dashboard', $data);
    }
}
