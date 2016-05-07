<?php
echo 'hello world';
include_once("error.php");
include_once("connection.php");
include_once("session.php");
include_once("form_functions.php");
include_once("functions.php");
if(isset($_POST['logout'])){
  session_destroy();
  redirect_to("index.php");
}
if(isset($_POST['login'])){
  $username = mysql_prep($connection,$_POST["username"]);
  $password = mysql_prep($connection,$_POST["password"]);
  $sql = "SELECT * FROM user_table WHERE user_name = '{$username}' AND password = '{$password}'";
  $result = mysqli_query($connection , $sql);
  if($row = mysqli_fetch_assoc($result)){
    session_start();
    $_SESSION['logged_in'] = "1";
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_type'] = $row['user_type'];
    redirect_to("index.php");
  }
  else{
    session_destroy();
    echo "hello world";
    //redirect_to("index.php");
  }
}
?>
