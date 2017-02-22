<?php
include_once("error.php");
include_once("connection.php");
include_once("form_functions.php");
include_once("functions.php");
include_once("session.php");
include("header.php");
if(isset($_SESSION['user_type']) && $_SESSION['user_type']==0)
{

?>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#previousResult">Previous result</button>
<div id="previousResult" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter semester to find result</h4>
      </div>
      <div class="Previous results">
        <form action="process.php" method="post">
          Previous semester :
          <select class="form-control" id="prev_res" name="prev_res">
            <option data-id=NULL value=NULL>-------</option>
            <?php
            $user_id=$_SESSION['user_id'];
            $sql="SELECT * FROM current_status WHERE user_id='{$user_id}'";
            $result=mysqli_query($connection,$sql);
            $row=mysqli_fetch_assoc($result);
            $curr_semester=$row['curr_semester'];
            $counter=1;
            $sem=array('0','1st','2nd','3rd','4th','5th','6th','7th','8th');
            while($counter<$curr_semester)
            {
              ?>
              <option data-id=<?php echo $counter;?>><?php echo $sem[$counter];?></option>
              <?php
              $counter++;
            }
            ?>
          </select>
          <!--<input type="submit" value="xxx" name='result'>-->
        </form>
        <!--eikhane ekta table thakbe jeitay database er result table theke ekta particular semester er result-->
        <div id="result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</br>
</br>
<?php
$user_id=$_SESSION['user_id'];

$sql="SELECT * FROM current_status WHERE user_id='{$user_id}'";
$result=mysqli_query($connection,$sql);
if($row=mysqli_fetch_assoc($result))
{
  $curr_semester=$row['curr_semester'];
  $sql="SELECT * FROM subject WHERE semester='{$curr_semester}'";
  $subjects=mysqli_query($connection,$sql);
  ?>
  <div class="table-responsive">
    <table class="table table-striped">
      <tr>
        <th>Course title</th>
        <th>Mid1</th>
        <th>Mid2</th>
        <th>Attendance</th>
      </tr>
      <?php
      while($subject = mysqli_fetch_assoc($subjects))
      {
        $subject_id=$subject['subject_id'];
        $subject_name=$subject['subject_name'];
        if($subject_name!="Viva-Voce")
        {
          $sql="SELECT * FROM continuous_assessment WHERE user_id='{$user_id}' AND subject_id='{$subject_id}'";
          $result=mysqli_query($connection,$sql);
          $row=mysqli_fetch_assoc($result);
          if($row['mid1']==NULL){
            $mid1="TBA";
          }
          else {
            $mid1=$row['mid1'];
          }
          if($row['mid2']==NULL){
            $mid2="TBA";
          }
          else {
            $mid2=$row['mid2'];
          }
          if($row['attendance']==NULL){
            $attendance="TBA";
          }
          else {
            $attendance=$row['attendance'];
          }
          ?>
          <tr>
            <td><?php echo $subject_name;?></td>
            <td><?php echo $mid1; ?></td>
            <td><?php echo $mid2; ?></td>
            <td><?php echo $attendance; ?></td>
          </tr>
        <?php
        }

      }
      ?>
    </table>
  </div>
  <?php
}
else {
  ?>
  <form role="form" action="process.php" method="post">
    Current Semester:
    <select class="form-control" name="curr_semester" id="curr_semester">
      <option data-id=NULL value=NULL>-------</option>
      <option value='1'>1st</option>
      <option value='2'>2nd</option>
      <option value='3'>3rd</option>
      <option value='4'>4th</option>
      <option value='5'>5th</option>
      <option value='6'>6th</option>
      <option value='7'>7th</option>
      <option value='8'>8th</option>
    </select>
    <input type="submit" class="btn btn-info btn-md" value="Set Current Semester" name="current_semester">
  </form>
  <?php
}

$sql="SELECT * FROM profile WHERE user_id='{$user_id}'";
$result = mysqli_query($connection,$sql);
$row=mysqli_fetch_assoc($result);
if($row)
{

}
else {
  ?>
  <form role="form" action="process.php" method="post">
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="text" name="roll" placeholder="Roll Number" required>
    <input type="submit" class="btn btn-info btn-md" value="Update Profile" name="profile">
  </form>
  <?php
}
?>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#showAll">View Full Result</button>
<div id="showAll" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter semester to find result</h4>
      </div>
      <div class="all result">
        <form role="form" action="process.php" method="post">
          Choose Subject:
          <select class="form-control" id="subject" name="subject">
            <option value="">------</option>
            <?php
            $user_id=$_SESSION['user_id'];
            $sql="SELECT * FROM current_status WHERE user_id='{$user_id}'";
            $result=mysqli_query($connection,$sql);
            $row=mysqli_fetch_assoc($result);
            $curr_semester=$row['curr_semester'];
            $sql="SELECT * FROM subject WHERE semester='{$curr_semester}'";
            $result=mysqli_query($connection,$sql);
            //$counter=1;
            //$sem=array('0','1st','2nd','3rd','4th','5th','6th','7th','8th');
            while($row=mysqli_fetch_assoc($result))
            {
              $subject_id=$row['subject_id'];
              $subject_name=$row['subject_name'];
              if($subject_name!="Viva-Voce")
              {
                ?>
                <option data-id=<?php echo $subject_id;?>><?php echo $subject_name;?></option>
                <?php
              }
            }
            ?>
          </select>
          <!--<input type="submit" value="xxx" name='result'>-->
        </form>
        <!--eikhane ekta table thakbe jeitay database er result table theke ekta particular semester er result-->
        <div id="show"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#prev_res').change(
  function()
  {
    //console.log("whatevr");
    //alert($(this).find(':selected').data('id'));
    $.ajax({
      type:"POST",
      url:"process.php",
      data:{result:$(this).find(':selected').data('id')},
      success:function(data){
        console.log(data);
        $('#result').html(data);
      }
    });
  }
);


$('#subject').change(
  function()
  {
    //console.log("whatevr");
    //alert($(this).find(':selected').data('id'));
    $.ajax({
      type:"POST",
      url:"process.php",
      data:{all_res:$(this).find(':selected').data('id')},
      success:function(data){
        console.log(data);
        $('#show').html(data);
      }
    });
  }
);
</script>
<?php
include("footer.php");
}
else {
  redirect_to("index.php");
}
?>
