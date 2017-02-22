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
//echo 'hello world';
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
    //echo "hello world";
    ?>
    <form role="form" action="index.php" method="post" id="err">
    <p id="error">User name or Password is wrong.<br> Please Check!!!</p>
      <input type="submit" class="btn btn-danger btn-lg" value="Go Back">
    </form>


    <?php
    //redirect_to("index.php");
  }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

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
