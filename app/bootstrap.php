<?php
    // load config
    require_once 'config/config.php';

    // load helpers
    require_once 'helpers/url_helper.php';

    // load session Helper
    require_once 'helpers/session_helper.php';

    // load libraries
    /** auto add libraries to this file without typing manually
     *  all files found in libraries folder are loaded on start
     */
    spl_autoload_register(function ($className){
        require_once 'libraries/' .$className. '.php';
    });