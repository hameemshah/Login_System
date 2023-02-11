<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign Up</title>
</head>
<body>
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
    <script src="js/script.js"></script>
</body>
</html>
<!-- PHP code for form validation -->
<?php #Form handling script
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Validate the username and password and confirm password are not empty
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm'])) {
        //Validate that both password and confirm password are same.
        if ($_POST['password'] != $_POST['confirm']) {
            echo "<script>
                        document.getElementById('error').style.display = 'block';
                    </script>";
        }
        else{
            $username = trim(strip_tags($_POST['username']));
            $password = trim(strip_tags($_POST['password']));
                if (strlen($username) < 3) {
                    echo "<script>
                                document.getElementById('error').innerHTML = '⚠️ Username should be at least three characters.';
                                document.getElementById('error').style.display = 'block';
                            </script>";
                }
                else if (strlen($password) < 6) {
                    echo '<p class="error">Password should be at least six characters.';
                    echo "<script>
                                document.getElementById('error').innerHTML = '⚠️ Password should be at least six characters.';
                                document.getElementById('error').style.display = 'block';
                            </script>";
                }
                else if (!preg_match("/^[a-zA-Z0-9@._-]+$/", $username)) {
                    echo "<script>
                                document.getElementById('error').innerHTML = '⚠️ $username is not valid. <br/>Only alphanumeric characters and @ . - _ symbols are allowed..';
                                document.getElementById('error').style.display = 'block';
                            </script>";
                }
                else {
                    echo "<script>
                                document.getElementById('error').innerHTML = '✅ Account created successfully.';
                                document.getElementById('error').style.color = 'green';
                                document.getElementById('error').style.display = 'block';
                            </script>";
                    exit;
                }
        }
    } else {
        $username = null;
        echo '<p class="error"></p>';
        echo "<script>
        document.getElementById('error').innerHTML = '⚠️ Please fill all the fields!';
        document.getElementById('error').style.display = 'block';
    </script>";
    }
}
    ?>