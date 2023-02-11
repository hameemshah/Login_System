<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .error {
    font-weight: bold;
    color: #c00;
}
    </style>
    <title>Login</title>
</head>
<body>
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
    <script src="js/script.js"></script>
</body>
</html>
<?php
#Form handling script
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Validate the username and password and confirm password are not empty
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        //Validate that both password and username size.
            $username = trim(strip_tags($_POST['username']));
            $password = trim(strip_tags($_POST['password']));
                if (strlen($username) < 3) {
                    echo "<script>
                                document.getElementById('error').innerHTML = '⚠️ Username should be at least three characters.';
                                document.getElementById('error').style.display = 'block';
                            </script>";
                }
                else if (strlen($password) < 6) {
                    echo "<script>
                                document.getElementById('error').innerHTML = '⚠️ Password should be at least six characters.';
                                document.getElementById('error').style.display = 'block';
                            </script>";
                }
                //Validate username
                else if (!preg_match("/^[a-zA-Z0-9@._-]+$/", $username)) {
                    echo "<script>
                                document.getElementById('error').innerHTML = '⚠️ $username is not valid.<br/> Only alphanumeric characters and @ . - _ symbols are allowed.';
                                document.getElementById('error').style.display = 'block';
                            </script>";
                }
                else {
                    echo "<script>
                                document.getElementById('error').innerHTML = '✅ You have successfully logged in.';
                                document.getElementById('error').style.color = 'green';
                                document.getElementById('error').style.display = 'block';
                            </script>";
                    exit;
                }
    } else {
        $username = null;
        echo "<script>
        document.getElementById('error').innerHTML = '⚠️Please fill all the fields!';
        document.getElementById('error').style.display = 'block';
    </script>";
    }
}
?>