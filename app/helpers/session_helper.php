<?php

/**
 * session variable lives while user is logged in
 * we use it to store info about the connected user
 * we destroy it on logout
 */

// start session
session_start();


/**
 * method to display flash messages
 * @param string $name
 * @param string $message
 * @param string $class
 */
// flash messages helper
function flash($name = '', $message = '', $class = 'alert alert-success'){

    if (!empty($name)){
        if (!empty($message) && empty($_SESSION[$name])){

            if (!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name. '_class'])){
                unset($_SESSION[$name. '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;

        } elseif (empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="'.$class.'" id=msg-flash">' .$_SESSION[$name]. '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
}
