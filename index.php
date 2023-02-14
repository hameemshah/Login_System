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
        echo "<script>
                    document.getElementById('error').innerHTML = '✅ You have successfully logged in.';
                    document.getElementById('error').style.color = 'green';
                    document.getElementById('error').style.display = 'block';
                </script>";
        //Set the session data:
        session_start();
        $_SESSION['username'] = $username;
        //Redirect:
        redirect_user('loggedin.php');
    }
    mysqli_close($dbc); //Close the database connection
}
?>