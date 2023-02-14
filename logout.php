<?php
    //This page lets the user to logout.

    session_start(); //start session

    //If no session is present, redirect the user user:
    if (!isset($_SESSION['username'])) {

        //Need the fuctions and header with page title
        $page_title = 'Logged Out!';
        require ('partials/header.php');
        redirect_user();
    } else { //Delete the session
        $_SESSION = array(); //Clear the variables.
        session_destroy(); //Destroy the session itself.
        setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, 0); //Destroy the cookie.
    }
    //Print the customized message
    echo "<h1>Logged Out!</h1>
                <p>You are now logged out!</p>";
    
    include ('partials/footer.php');
    ?>