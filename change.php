<?php
    session_start(); //Start session
    $user_id = $_GET['user_id'];
    $page_title = 'Change Password';
    include 'partials/header.php';
    //If users is not logged in  (session is not set) then redirect to login page.
    if (!isset($_SESSION['username'])) {
        redirect_user();
        exit();
    }
    ?>
    <div class="login">
        <h1>Change Password</h1>
        <h4>Enter New Password.</h4>
        <div class="form">
            <form action="" method="post" name="change" onsubmit="return validatePassword();" id="change" enctype="application/x-www-form-urlencoded">
                <p>
                <input type="password"  name="password" id="password"  placeholder="New Password" >
                </p>
                <p>
                <input type="password" name="confirm" id="confirm" placeholder="Confirm Password">
                </p> 
                <span id="error"></span>
                <p>
                <input type="submit" value="Change" class="submit">
                </p>
                <br>
            </form>
        </div>
    </div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Validate the username and password and confirm password are not empty
    $confirm = $_POST['confirm'];
    $password = $_POST['password'];
    $validated = check_change($confirm, $password);

    if ($validated) {
        $q = "UPDATE users SET password = SHA1('$password') WHERE s_no = '$user_id'";
        $r = mysqli_query($dbc, $q);
        if ($r) {
            //Display Success message if everything went right and query was executed successfully.
            echo "<script>
                        document.getElementById('error').innerHTML = '✅ Password changed successfully.';
                        document.getElementById('error').style.color = 'green';
                        document.getElementById('error').style.display = 'block';
                     </script>";  
        }
        else {
            echo "<script>
                document.getElementById('error').innerHTML = '⚠️Error occured.';
                document.getElementById('error').style.color = 'red';
                document.getElementById('error').style.display = 'block';
         </script>";             
        }
    }
} ?> <button><a href="logout.php">Log Out!</a></button>  <php 
include 'partials/footer.php'; 
