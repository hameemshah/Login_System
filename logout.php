<?php
    //This page lets the user to logout.
    session_start(); //start session

    //Need the fuctions and header with page title
    require ('partials/login_functions.ini.php');
    //Delete the session
    $_SESSION = array(); //Clear the variables.
    session_destroy(); //Destroy the session itself.
    setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, 0); //Destroy the cookie.
    redirect_user();
    ?>