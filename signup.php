<?php    
     //Set the page title
    $page_title = 'Sign Up';
    include 'partials/header.php'; 
?>
    <div class="login">
        <h1>Admin Register</h1>
        <h4>Create your username and password</h4>
        <div class="form">
            <form action="signup.php" method="post" id="signup" name="signup" onsubmit="return validatePassword();" enctype="application/x-www-form-urlencoded">
                <p>
                <input type="text"  name="username" id="username" oninput="validateUsername();"  placeholder="Username" minlength="3" autofocus required>
                </p>
                <p>
                <input type="password" name="password" id="password" placeholder="Password" minlength="6" required>
                </p> 
                <p>
                    <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" minlength="6" required>
                </p>
                <span id="error">⚠️ Password and confirm password should be same.</span>
                <p>
                <input type="submit" value="Sign Up" class="submit">
                </p>
                <h5>Already have an account? <a href="index.php">Log In </a>here.</h5>  
                <br/>
            </form>
        </div>
    </div>
<!-- PHP code for form validation -->
<?php #Form handling script
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim(strip_tags($_POST['username']));
        $password = trim(strip_tags($_POST['password']));
        $confirm = trim(strip_tags($_POST['confirm']));
        $validated = check_signup($username, $password, $confirm);
    //If validation test passed then execute the Insert query.
    if ($validated) {
        $q = "INSERT INTO users (username, password) VALUES ('$username', SHA1('$password'))";
        $r = @mysqli_query($dbc, $q); //Run the query
        if ($r) { //If query run successfully

            //Print the message
            echo '<h1>Thank You</h1>';
            echo '<p>You are now registered. You can now log in on login page.</p>';
            //Display Success message if everything went right and query was executed successfully.
            echo "<script>
                        document.getElementById('error').innerHTML = '✅ Account created successfully.';
                        document.getElementById('error').style.color = 'green';
                        document.getElementById('error').style.display = 'block';
                    </script>";  
        } else { //If it did not run OK.
       
            //Check for duplicate entry the error code 1062 means duplicate entry
            if (mysqli_errno($dbc) == 1062) {
                echo "Error: The username '$username' is already taken. Please choose a different one.";
                echo "<script>
                            document.getElementById('error').innerHTML = '⚠️ The username  is already taken.';
                            document.getElementById('error').style.display = 'block';
                        </script>";  
            } else {
            //Public message
            echo '<h1>System Error</h1>';
            echo '<p>You could not register due to system error. </p>';
            //Debugging message
            echo '<p>' . mysqli_error($dbc) . '<br/><br/> Query: ' . $q . '</p>';
            }
        } 
        //End of  if($r) If.
        mysqli_close($dbc); //Close the connection.
    }
}
include 'partials/footer.php';
?>