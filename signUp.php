<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="stylesheet.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <title>home</title>
</head>
<body>
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
    ?>
    <form  id="err" role="form" action="index.php" method="post">
      <p id="error">Password doesn't match !!!</p>
      <input type="submit" class="btn btn-danger btn-lg" value="Go Back">
    </form>
    <?php
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
        $sql="SELECT * FROM user_table WHERE user_name='{$username}'";
        $result=mysqli_query($connection,$sql);
        $row=mysqli_fetch_assoc($result);
        $user_id=$row['user_id'];
        session_start();
        $_SESSION['logged_in']="1";
        $_SESSION['user_type']=NULL;
        $_SESSION['user_id']=$user_id;

        redirect_to("index.php");
      }
    else{
    ?>
    <form  id="err" role="form" action="index.php" method="post">
    <p id="error">Username already exists!!!</p>
      <input type="submit" class="btn btn-danger btn-lg" value="Go Back">
    </form>

    <?php
    }

  }
}
 ?><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

 <script  type = "text/javascript" src = "bootstrap/js/bootstrap.min.js"></script>

 <script type="text/javascript">

 $(function() {
      var pgurl = window.location.href.substr(window.location.href
 .lastIndexOf("/")+1);
      $("ul.nav li a").each(function(){
           if($(this).attr("href") == pgurl)
             $(this).parent('li').addClass("active");
      })
 });
 </script>

 </body>
 </html>
