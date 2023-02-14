<?php 
    //Start the session before headers are set
    session_start();
    //The User will be redirected here from index.php

    //Set the page title
    $page_title = 'Logged In';

    //Include login functions 
    require ('partials/header.php');
    //If no session variable is not set, redirect the user to login page:
    if (!isset($_SESSION['username'])) {
        redirect_user();
        exit();
    }

    //Print a customized message:
    echo "<h1>Logged In!</h1>
        <p>You are now logged in, {$_SESSION['username']}!</p>
        <p><a href=\"logout.php\">Logout</a></p>";
        include ('partials/footer.php');
?>