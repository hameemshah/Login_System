<?php $page_title = 'Log In'; ?>
<?php include 'partials/header.php' ?>
    <div class="login">
        <h1>Admin Login</h1>
        <h4>Enter your Username and Password</h4>
        <div class="form">
            <form action="index.php" method="post" name="login" id="login" enctype="application/x-www-form-urlencoded">
                <p>
                <input type="text"  name="username" id="username" oninput="validateUsername();" minlength="3" placeholder="Username" autofocus required>
                </p>
                <p>
                <input type="password" name="password" id="password" placeholder="Password" minlength="6" required>
                </p> 
                <span id="error"></span>
                <p>
                <input type="submit" value="Log In" class="submit">
                </p>
                <h5>Don't have an account? <a href="signup.php">Sign Up </a>here.</h5>  
                <br/>
            </form>
        </div>
    </div>
<?php include 'partials/footer.php' ?>
<?php
#Form handling script
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Validate the username and password and confirm password are not empty
    $username = trim(strip_tags($_POST['username']));
    $password = trim(strip_tags($_POST['password']));
    $validated = check_login($username, $password);
    if ($validated) {
        //Get the user data from the data base

        //Prepare a statement
        $stmt = mysqli_prepare($dbc, "SELECT * FROM users WHERE username = ?" );

        //Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "s", $username);

        if (mysqli_stmt_execute($stmt)) {
            //Get the data
            $result = mysqli_stmt_get_result($stmt);
            $user_found = false;
            while ($row =mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $user_found = true;
                if ($row['username'] == $username) {
                    if ($row['password'] == SHA1($password)) {
                        //Set the session data:
                        session_start();
                        $_SESSION['username'] = $username;
                        //Redirect:
                        redirect_user('user_data.php');
                    }
                    else {
                        echo "<script>
                                    document.getElementById('error').innerHTML = '⚠️Incorrect Password.';
                                    document.getElementById('error').style.display = 'block';
                                </script>";
                    }
                }
            }
            if (!$user_found) {
                echo 'User not found!';
                echo "<script>
                            document.getElementById('error').innerHTML = '⚠️ No Username found.';
                            document.getElementById('error').style.display = 'block';
                        </script>";
            }
        }
        else {
            echo "<h1 class='error'>Error Occurred</h1>";
            //Debugging message
            echo '<p>' . mysqli_error($dbc) . '<br/><br/> Query : ' . $q . '</p>';
        }
        //Close the statemet
        mysqli_stmt_close($stmt);
    }
    mysqli_close($dbc); //Close the database connection
}
?>