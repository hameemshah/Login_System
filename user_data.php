<?php
    session_start(); //Start session
    $page_title = 'View the Current Users'; 
    include 'partials/header.php';
    //If users is not logged in  (session is not set) then redirect to login page.
    if (!isset($_SESSION['username'])) {
        redirect_user();
        exit();
    }
    echo '<h1>Registered Users</h1>';
    //Database Query
    $q = "SELECT username, password, create_time FROM users ORDER BY create_time ASC";
    $r = @mysqli_query($dbc, $q);

    if ($r) {
        echo "<h4>You are logged in as, {$_SESSION['username']}</h4>";
        echo "<table align='center' cellspacing='3' cellpadding='3' width='75%' border>
                    <tr>
                        <th align='left'><b>Username</b></th>
                        <th align='left'><b>Password</b></th>
                        <th align='left'><b>Register Date & Time</b></th>
                    </tr>";
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo '<tr>
                        <td align="left">' . $row['username'] . '</td>
                        <td align="left">' . $row['password'] . '</td>
                        <td align="left">' . $row['create_time'] . '</td>
                     </tr>';
        }
        echo '</table>';
        mysqli_free_result($r); //Free up the resources. 
    }
    else { //If it did not run.
        //Public message
        echo '<p class="error">The current users could not be retrieved.';

        //Debugging message
        echo '<p>' . mysqli_error($dbc) . '<br/><br/> Query : ' . $q . '</p>';
}
?> <button><a href="logout.php">Log Out!</a></button> <?php
include 'partials/footer.php';