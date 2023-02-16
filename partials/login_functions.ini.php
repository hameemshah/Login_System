<?php
    //This function contains two functions used by the login/logout process

    /*This function determines an absolute URL and redirects the user there.
        *The function takes one argument: the page to be redirected to.
        *The argument defaults to index.php
    */
    function redirect_user ($page = '') {
        //Start defining the URL...
        //URL is http:// plus the host name plus the current directory:
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

        //Remove any trailing slashes:
        $url = rtrim($url, '/\\');

        //Add the page:
        $url .= '/' . $page;

        //Redirect the user:
        header("Location: $url");
        exit(); //Quit the script.
    } //End of redirect_user() function.
    
    /*This function validats the username and password fields and queries database accordingly*/

function check_signup($username, $password, $confirm) {

    //Check if fields are not empty
    if (empty($username) && empty($password) && empty($confirm)) {
        echo "<script>
        document.getElementById('error').innerHTML = '⚠️ Please fill all the fields!';
        document.getElementById('error').style.display = 'block';
    </script>";
    return false;
    }
    //Check that username is alphanumeric with only selected special symbols allowed
    if (!preg_match("/^[a-zA-Z0-9@._-]+$/", $username)) {
        echo "<script>
                    document.getElementById('error').innerHTML = '⚠️ $username is not valid. <br/>Only alphanumeric characters and @ . - _ symbols are allowed..';
                    document.getElementById('error').style.display = 'block';
                </script>";
        return false;
    }
    //Check the password length is greater than 6
    if (strlen($password) < 6) {
        echo "<script>
                    document.getElementById('error').innerHTML = '⚠️ Password should be at least six characters.';
                    document.getElementById('error').style.display = 'block';
                </script>";
        return false;
    }
    //Validate that both password and confirm password are same.
    if ($password != $confirm) {
            echo "<script>
                        document.getElementById('error').style.display = 'block';
                    </script>";
        return false;
    }
    //Check username is atleast 3 characters long
    if (strlen($username) < 3) {
        echo "<script>
                    document.getElementById('error').innerHTML = '⚠️ Username should be at least three characters.';
                    document.getElementById('error').style.display = 'block';
                 </script>";
        return false;
    }
    return true;
}

function check_login($username, $password) {
    //Check whether empty values
    if (empty($username) && empty($password)) {
        echo "<script>
                    document.getElementById('error').innerHTML = '⚠️Please fill all the fields!';
                    document.getElementById('error').style.display = 'block';
                </script>";
        return false;
        }
    //Validate username
    if (!preg_match("/^[a-zA-Z0-9@._-]+$/", $username)) {
        echo "<script>
                    document.getElementById('error').innerHTML = '⚠️ $username is not valid.<br/> Only alphanumeric characters and @ . - _ symbols are allowed.';
                    document.getElementById('error').style.display = 'block';
                </script>";
        return false;
    }
    //Validate username size
    if (strlen($username) < 3) {
        echo "<script>
                    document.getElementById('error').innerHTML = '⚠️Username should be at least three characters.';
                    document.getElementById('error').style.display = 'block';
                </script>";
        return false;
    }
    //Validate password size
    if (strlen($password) < 6) {
        echo "<script>
                    document.getElementById('error').innerHTML = '⚠️ Password should be at least six characters.';
                    document.getElementById('error').style.display = 'block';
                </script>";
        return false;
    }
     return true;
}

function check_change($confirm, $password)
{
    //Check whether empty values
        if (empty($confirm) && empty($password)) {
            echo "<script>
                        document.getElementById('error').innerHTML = '⚠️Please fill all the fields!';
                        document.getElementById('error').style.display = 'block';
                    </script>";
            return false;
            }

    //Check the password length is greater than 6
        if (strlen($password) < 6 || strlen($confirm) < 6) {
            echo "<script>
                        document.getElementById('error').innerHTML = '⚠️ Password should be at least six characters.';
                        document.getElementById('error').style.display = 'block';
                    </script>";
            return false;
        }

    //Validate that both password and confirm password are same.
        if ($password != $confirm) {
                echo "<script>
                            document.getElementById('error').innerHTML = '⚠️ Password should be same.';
                            document.getElementById('error').style.display = 'block';
                        </script>";
            return false;
        }
    return true;
}