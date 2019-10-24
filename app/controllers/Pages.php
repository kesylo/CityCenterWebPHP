<?php

/**
 * @property mixed planningModel
 */
class Pages extends Controller {        // default controller

    //private $planningModel;

    /**
     * Pages constructor.
     */
    public function __construct()
    {

    }

    // default method
    public function index(){
        // prepare data to send to view
        $data = [
            'title' => 'CityCenterPlanning'
        ];

        // view from the controller class we inherited
        $this->view('pages/index', $data);
    }

    public function about(){
        $data = [
            'title' => 'A propos'
        ];

        // load the about page
        $this->view('pages/about', $data);
    }


}
