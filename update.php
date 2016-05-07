<?php

include_once("error.php");
include_once("connection.php");
include_once("form_functions.php");
include_once("functions.php");
include_once("session.php");


if(isset($_POST['approve'])){
  $sql = "SELECT * FROM user_table WHERE user_type IS NULL";
  $result = mysqli_query($connection,$sql);
  while($row = mysqli_fetch_assoc($result))
{
  $user_id=$row['user_id'];
$user_type=$_POST[$user_id];
$sql = "UPDATE user_table SET user_type='{$user_type}' WHERE user_id='{$user_id}' ";
mysqli_query($connection,$sql);
}
redirect_to("update_OA.php";)
}
?>
