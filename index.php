<?php
include_once("header.php");

include_once("connection.php");
include_once("form_functions.php");
include_once("functions.php");


?>
<div class="table-responsive">
  <h1>Notice Board</h1>
 <table class="notice table table-striped table-responsive">
   <tr>
     <th>Date</th>
     <th>Description</th>
   </tr>
   <?php
    $sql="SELECT * FROM notice ORDER BY published DESC";
    $result=mysqli_query($connection,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
      ?>
      <tr>
      <td><?php echo $row['published'];?></td>
      <td><?php echo $row['description'];?></td>
    </tr>
      <?php
    }
   ?>
 </table>
</div>

<?php
include("footer.php");
 ?>
