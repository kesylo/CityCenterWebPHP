<?php
/**
 * App core class
 * creates url & loads core controller
 * rul format: /controller/method/params
 */

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = "index";
    protected $params = [];

    /**
     * Core constructor.
     */
    public function __construct()
    {
        // print url params in an array (print_r print arrays without loop)
        //print_r($this->getUrl());

        $url = $this->getUrl();

        // look in controllers for first value of array
        if (file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
            // if exists set as current controller
            $this->currentController = ucwords($url[0]);
            // unset 0 index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/'. $this->currentController .'.php';

        // instantiate it
        $this->currentController = new $this->currentController;

        // check for second param of url
        if (isset($url[1])){
            // check if method exist in controller
            if (method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                // unset index
                unset($url[1]);
            }
        }

        // get remaining params
        $this->params = $url ? array_values($url) : [];

        // call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }


    public function getUrl(){
        /**
         * get value of params in the request in browser. http://localhost/CityAppPlanningPHP/LOIC
         * we will get = LOIC
         *
         */

        // make sure the url format is ok
        if (isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // break params values to array
            $url = explode('/', $url);
            return $url;
        }
    }
}
