<?php
    session_start(); //Start session
    $user_id = $_GET['user_id'];
    $page_title = 'Delete User';
    include 'partials/header.php';
    //If users is not logged in  (session is not set) then redirect to login page.
    if (!isset($_SESSION['username'])) {
        redirect_user();
        exit();
    }
    $q = "DELETE  FROM users WHERE s_no = $user_id";
    $r = mysqli_query($dbc, $q);
    redirect_user('user_data.php');
    if (!$r)  {
        //If query was not successful
        echo "<h1 class='error'>Error Occurred</h1>";
        echo "<p>There was an error while deleting the user.</p>";
        //Debugging message
        echo '<p>' . mysqli_error($dbc) . '<br/><br/> Query : ' . $q . '</p>';
    }
?>