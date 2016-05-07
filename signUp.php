<?php

include_once("error.php");
include_once("connection.php");
include_once("form_functions.php");
include_once("functions.php");
include_once("session.php");

if(isset($_POST["signup"])){
  $username = mysql_prep($connection,$_POST["username"]);
  $password = mysql_prep($connection,$_POST["passwd"]);
  $confirm_password = mysql_prep($connection,$_POST["conf_pass"]);

  if($password!=$confirm_password){
    $error[0]= "password doesn't match";
    display_errors($error);
    }
  else{
    $sql = "SELECT * FROM user_table WHERE user_name = '{$username}'";
    $result = mysqli_query($connection,$sql);
    $counter=0;
    while($row=mysqli_fetch_assoc($result)){
      $counter++;
    }
    if($counter==0){
        $sql="INSERT INTO user_table (user_name,password) values('{$username}','{$password}')";
        mysqli_query($connection,$sql);
        session_start();
        $_SESSION['logged_in']="1";
        $_SESSION['user_type']=NULL;
        redirect_to("index.php");
      }
    else{
    $error[0]= "user_name already exists.";
      display_errors($error);
    }

  }
}
 ?>
