function validateUsername() {
  const username = document.getElementById('username');
  const regex = /^[a-zA-Z0-9@._-]+$/;
  const result = regex.test(username.value);
  if (!result) {
    username.value = '';
    username.style.border = '2px solid red';
    username.style.boxShadow = "0 0 10px red";
    error.innerHTML = '⚠️ Username should be non empty and alphanumeric.<br><br>Only @ . _ - special character allowed.';
    error.style.display = 'block';
  }
  else {
    error.style.display = 'none';
    username.style.border = '1px solid blue';
    username.style.boxShadow = "0 0 10px #719ECE";
  }
}
//check password and confirm password are same or not
function  validatePassword() {
    const password = document.getElementById('password');
    const confirm = document.getElementById('confirm');
    //const error = document.getElementById('error');
    if(password.value != confirm.value) {
      error.style.color = 'red';
      error.innerHTML = '⚠️ Passwords should be equal.';
      error.style.display = 'block';
      return false;   
    }
    return true;
}