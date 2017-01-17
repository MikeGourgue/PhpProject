<?php

function my_password_check_n_hash($pwd, $pwd2) {
  $pass = [];
  if ($pwd == $pwd2) {
    $hash = password_hash($pwd, PASSWORD_DEFAULT);
    return $hash;
  } else {
    return false;
  }
}

function my_password_compare($php_pwd, $db_pwd)  {
  if (password_verify($php_pwd, $db_pwd)) {
    return true;
  } else {
    return false;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function remove_session() {
  unset($_COOKIE['auth']);
  setcookie('auth', '', Time()-4200);
  session_destroy();

  header('Location: login.php');
}

function set_session() {
  $_SESSION['auth'] = $_COOKIE['auth'];
  setcookie('auth', $_SESSION['auth'], Time() + 5000);
}


?>
