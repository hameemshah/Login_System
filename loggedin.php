<?php 
    //The User will be redirected here from index.php

    //Set the page title
    $page_title = 'Logged In';

    //Include login functions 
    require ('partials/header.php');
    //If no cookie is present, redirect the user to login page:
    if (!isset($_COOKIE['username'])) {
        redirect_user();
        exit();
    }

    //Print a customized message:
    echo "<h1>Logged In!</h1>
        <p>You are now logged in, {$_COOKIE['username']}!</p>
        <p><a href=\"logout.php\">Logout</a></p>";
        include ('partials/footer.php');
?>