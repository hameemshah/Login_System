<?php
    //This page lets the user to logout.

    //If no cookie is present, redirect the user user:
    if (!isset($_COOKIE['username'])) {

        //Need the fuctions and header with page title
        $page_title = 'Logged Out!';
        require ('partials/header.php');
        redirect_user();
    } else { //Delete the cookies
        setcookie('username', '', time()-3600, '/', '', 0, 0);
    }
    //Print the customized message
    echo "<h1>Logged Out!</h1>
                <p>You are now logged out, {$_COOKIE['username']}!</p>";
    
    include ('partials/footer.php');
    ?>