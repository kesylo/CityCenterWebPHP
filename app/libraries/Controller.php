<?php
/**
 * contains methods to load a model and a view
 * all controllers should inherit form this base controller
*/

class Controller {

    // load model
    public function model ($model){
        // require model file
        require_once '../app/models/' .$model . '.php';

        // instantiate model
        return new $model;
    }

    // load model
    // the data array is used to pass data to the view
    public function view ($view, $data = []){
        // check for view file
        if (file_exists('../app/views/' .$view . '.php')){
            require_once  '../app/views/' .$view . '.php';
        }else{
            die('View does not exist');
        }
    }

}
