<?php
include("connection.php");
include("form_functions.php");
include("functions.php");
include("session.php");
if(isset($_POST["signup"])){
  $username = mysql_prep($_POST["username"]);
  $password = mysql_prep($_POST["passwd"]);
  $confirm_password = mysql_prep($_POST["conf_passwd"]);
  if($password!=$confirm_password){
    display_errors("password does not match");
  }
  else{
    $sql = "SELECT*FROM user_table WHERE user_name = '{$username}'";
    $result = mysql_query($sql);
    if(!confirm_query($result)){
      $sql = "INSERT INTO user_table("user_name,password") values('{$username}' , '{$password}')";
      mysql_query($sql);
    }
    else{
      display_errors("user name already exists.");
    }

  }
}
 ?>
