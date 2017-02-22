<?php
//session_start();
//$_SESSION['user_type']=2;
//echo "hello";
ob_start();
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
    if($user_type!=-1 && $user_type!=NULL)
    {
      $sql = "UPDATE user_table SET user_type='{$user_type}' WHERE user_id='{$user_id}' ";
      mysqli_query($connection,$sql);
    }
    else if($user_type==-1) {
      # code...
      $sql ="DELETE FROM user_table WHERE user_id='{$user_id}'";
      mysqli_query($connection,$sql);
    }
  }
  redirect_to("update_OA.php");
}

if(isset($_POST['notice']))
{
  $desc=$_POST['description'];
  $time = date("Y/m/d H:i:s");
  $sql="INSERT INTO notice (description,published) VALUES('{$desc}','{$time}')";
  mysqli_query($connection,$sql);
  redirect_to("update_OA.php");
}

if(isset($_POST['assign']))
{
  $semester=$_POST['semester'];
  $sql="SELECT * FROM subject WHERE semester='{$semester}'";
  $subjects=mysqli_query($connection,$sql);
  while($subject = mysqli_fetch_assoc($subjects))
  {
    $subject_id=$subject['subject_id'];
    $teacher_id=$_POST[$subject_id];
    $sql="SELECT * FROM curr_subject WHERE subject_id='{$subject_id}'";
    $result = mysqli_query($connection,$sql);
    if($row=mysqli_fetch_assoc($result))
    {
      //echo "1";
      $sql="UPDATE curr_subject SET user_id='{$teacher_id}' WHERE subject_id='{$subject_id}'";
      mysqli_query($connection,$sql);
    }
    else {
      //echo "2";
      $sql="INSERT INTO curr_subject (user_id,subject_id) values('{$teacher_id}','{$subject_id}')";
      mysqli_query($connection,$sql);
    }
  }
  redirect_to("update_OA.php");
}

if(isset($_POST['semester']))
{
  $semester=$_POST['semester'];
  ?>
  <input hidden value=<?php echo $semester; ?> name="semester">
  <table class="table table-striped">
  <thead>
    <tr>
      <th>Subject Name</th>
      <th>Teacher's Name</th>
    </tr>
  </thead>
  <tbody>
  <?php

  $sql="SELECT * FROM subject WHERE semester='{$semester}' AND subject_name!='Viva-Voce'";
  $result=mysqli_query($connection,$sql);
  while($row = mysqli_fetch_assoc($result))
  {
    ?>
    <tr>
      <td><?php echo $row['subject_name']?></td>
      <td><select class="form-control" name="<?php echo $row['subject_id'];?>">
        <option data-id=NULL value=NULL>------</option>
        <?php
          $sql="SELECT * FROM user_table WHERE user_type=1";
          $teachers=mysqli_query($connection,$sql);
          while($teacher = mysqli_fetch_assoc($teachers))
          {
            ?>
              <option value=<?php echo $teacher['user_id'];?>><?php echo $teacher['user_name'];?></option>
            <?php
          }
        ?>
      </select></td>
    </tr>
    <?php
  }
  ?>
</tbody>
</table>
  <?php
}
if(isset($_POST['current_semester']))
{
  $user_id=$_SESSION['user_id'];
  $curr_semester=$_POST['curr_semester'];
  if($curr_semester==0)
    redirect_to("students_profile.php");
  $sql="INSERT INTO current_status (user_id,curr_semester) VALUES('{$user_id}','{$curr_semester}')";
  mysqli_query($connection,$sql);
  $sql="SELECT * FROM subject WHERE semester='{$curr_semester}'";
  $subjects=mysqli_query($connection,$sql);
  while($subject = mysqli_fetch_assoc($subjects))
  {
    $subject_id=$subject['subject_id'];
    $sql="INSERT INTO continuous_assessment (user_id,subject_id) VALUES('{$user_id}','{$subject_id}')";
    mysqli_query($connection,$sql);
  }
  redirect_to("students_profile.php");
}
if(isset($_POST['result']))
{
  //echo "hilo";
  $user_id=$_SESSION['user_id'];
  $semester=$_POST['result'];
  //echo $user_id." ".$semester;
  $sql="SELECT * FROM subject WHERE semester='{$semester}'";
  $subjects=mysqli_query($connection,$sql);
  ?>

  <table class="table table-striped">
    <tr>
      <th>Course title</th>
      <th>Credit</th>
      <th>GPA</th>
    </tr>
    <tbody>
  <?php
  while($subject = mysqli_fetch_assoc($subjects))
  {
    $subject_name=$subject['subject_name'];
    $subject_id=$subject['subject_id'];
    $credit=$subject['credit'];
    $sql="SElECT * FROM result WHERE user_id='{$user_id}' AND subject_id='{$subject_id}'";
    $result=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);
    $gpa=$row['gpa'];
    ?>
    <tr>
      <td><?php echo $subject_name;?></td>
      <td><?php echo $credit;?></td>
      <td><?php echo $gpa;?></td>
    </tr>
    <?php
  }
  ?>
</tbody>
</table>
  <?php
  //redirect_to("students_profile.php");
}
/**/

if(isset($_POST['mid_mark']))
{
  $curr_sem=$_POST['mid_mark'];
  $user_id=$_SESSION['user_id'];
  $sql="SELECT * FROM curr_subject WHERE user_id='{$user_id}'";
  $subjects=mysqli_query($connection,$sql);
  ?>
  <select class="form-control" id="choose_subject">
    <option data-id=null>-----</option>
  <?php
  while($subject=mysqli_fetch_assoc($subjects))
  {
    $subject_id=$subject['subject_id'];
    $sql="SELECT * FROM subject WHERE subject_id='{$subject_id}'";
    $result=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);
    $semester=$row['semester'];
    $subject_name=$row['subject_name'];
    $curr_subject_id="";
    if($semester==$curr_sem)
    {
      $curr_subject_id=$subject_id;
      $curr_subject_name=$subject_name

      ?>
      <option data-id=<?php echo $curr_subject_id;?>><?php echo $curr_subject_name;?></option>
      <?php
    }
  }
  ?>
  </select>
  <script type="text/javascript">
  $('#choose_subject').change(
    function()
    {
      console.log("whatevr");
      //alert($(this).find(':selected').data('id'));
      $.ajax({
        type:"POST",
        url:"process.php",
        data:{choose_subject:$(this).find(':selected').data('id')},
        success:function(data){
          //console.log(data);
          $('#student').html(data);
        }
      });
    }
  );
  </script>
  <?php
}


if(isset($_POST['choose_subject']))
{
  $curr_subject_id=$_POST['choose_subject'];
  $user_id=$_SESSION['user_id'];
  $sql="SELECT * FROM subject WHERE subject_id='{$curr_subject_id}'";
  $result=mysqli_query($connection,$sql);
  $row=mysqli_fetch_assoc($result);
  $curr_sem=$row['semester'];
  ?>
  <input hidden value=<?php echo $curr_sem; ?> name="semester">
  <input hidden value=<?php echo $curr_subject_id; ?> name="subject_id">
  <?php
  $sql="SELECT * FROM continuous_assessment WHERE subject_id='{$curr_subject_id}'";
  $result=mysqli_query($connection,$sql);
  ?>
  <table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th>Student's Name</th>
      <th>Roll</th>
      <th>Mid1</th>
      <th>Mid2</th>
      <th>Attendance</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($row=mysqli_fetch_assoc($result))
  {
    $user_id=$row['user_id'];
    $sql="SELECT * FROM profile WHERE user_id='{$user_id}'";
    $students=mysqli_query($connection,$sql);
    $student=mysqli_fetch_assoc($students);
    $full_name=$student['full_name'];
    $roll=$student['roll'];
    $mid1=$row['mid1'];
    $mid2=$row['mid2'];
    $attendance=$row['attendance'];
    ?>
    <tr>
      <td><?php echo $full_name; ?></td>
      <td><?php echo $roll; ?></td>
      <?php
        if($mid1==NULL)
        {
          ?>
          <td><input type="text" name=<?php echo $user_id ; ?> placeholder="Mid1 Marks">
          <td><input type="text" value='' name="mid2" disabled></td>
          <td><input type="text" value='' name="attendance" disabled></td>
          <?php
        }
        else if($mid2==NULL)
        {
          ?>
          <td><input type="text" value=<?php echo $mid1 ;?> name="mid1" disabled></td>
          <td><input type="text" value='' name=<?php echo $user_id;?> placeholder="Mid2 Marks">
          <td><input type="text" value='' name="attendance" disabled></td>
          <?php
        }
        else if($attendance==NULL) {
          ?>
          <td><input type="text" value=<?php echo $mid1 ;?> name="mid1" disabled></td>
          <td><input type="text" value=<?php echo $mid2 ;?> name="mid2" disabled></td>
          <td><input type="text" value='' name=<?php echo $user_id;?> placeholder="Attendance Marks"></td>
          <?php
        }
        else {
          ?>
          <td><input type="text" value=<?php echo $mid1 ; ?> name="mid1" disabled></td>
          <td><input type="text" value=<?php echo $mid2 ; ?> name="mid2" disabled></td>
          <td><input type="text" value=<?php echo $attendance; ?> name="attendance" disabled></td>
          <?php
        }
      ?>
    </tr>
    <?php
  }
  ?>
</tbody>
</table>

  <?php
}

if(isset($_POST['profile']))
{
  $user_id=$_SESSION['user_id'];
  $full_name=$_POST['full_name'];
  $roll=$_POST['roll'];
  $sql = "INSERT INTO profile (user_id,full_name,roll) VALUES('{$user_id}','{$full_name}','{$roll}')";
  mysqli_query($connection,$sql);
  redirect_to("students_profile.php");
}

if(isset($_POST['add_mid']))
{
  $curr_sem=$_POST['semester'];
  $user_id=$_SESSION['user_id'];
  $curr_subject_id=$_POST['subject_id'];
  //echo $curr_subject_id;
  $sql="SELECT * FROM continuous_assessment WHERE subject_id='{$curr_subject_id}'";
  $result=mysqli_query($connection,$sql);
  while($row=mysqli_fetch_assoc($result))
  {
    echo $row['user_id']." ".$_POST[$row['user_id']]."<br>";
    $user_id=$row['user_id'];

    $mid1=$row['mid1'];
    $mid2=$row['mid2'];
    $attendance=$row['attendance'];

    if($mid1==NULL)
    {
      $marks=$_POST[$user_id];
      $sql = "UPDATE continuous_assessment SET mid1='{$marks}' WHERE user_id='{$user_id}' AND subject_id='{$curr_subject_id}'";
      mysqli_query($connection,$sql);
    }
    else if($mid2==NULL && $mid1!=NULL)
    {
        $marks=$_POST[$user_id];
        $sql = "UPDATE continuous_assessment SET mid2='{$marks}' WHERE user_id='{$user_id}' AND subject_id='{$curr_subject_id}'";
        mysqli_query($connection,$sql);
    }

    else if($attendance==NULL) {
        $marks=$_POST[$user_id];
        $sql = "UPDATE continuous_assessment SET attendance='{$marks}' WHERE user_id='{$user_id}' AND subject_id='{$curr_subject_id}'";
        mysqli_query($connection,$sql);
      }
    else {

      }

  }
  redirect_to("update_T.php");
}

if(isset($_POST['all_res']))
{
  $subject_id=$_POST['all_res'];
  $user_id=$_SESSION['user_id'];
  $sql="SELECT * FROM current_status WHERE user_id='{$user_id}'";
  $result=mysqli_fetch_assoc(mysqli_query($connection,$sql));
  $curr_sem=$result['curr_semester'];
  ?>
  <table class="table table-striped">
    <tr>
      <th>Full Name</th>
      <th>Roll</th>
      <th>Mid1</th>
      <th>Mid2</th>
      <th>Attendance</th>
    </tr>
    <tbody>
  <?php
  $sql="SELECT * FROM current_status WHERE curr_semester='{$curr_sem}'";
  $result=mysqli_query($connection,$sql);
  while($row=mysqli_fetch_assoc($result))
  {
    $st_id=$row['user_id'];
    $sql="SELECT * FROM profile WHERE user_id='{$st_id}'";
    $res=mysqli_query($connection,$sql);
    $st=mysqli_fetch_assoc($res);
    $full_name=$st['full_name'];
    $roll=$st['roll'];
    $sql="SELECT * FROM continuous_assessment WHERE user_id='{$st_id}' AND subject_id='{$subject_id}'";
    $r=mysqli_query($connection,$sql);
    $mark=mysqli_fetch_assoc($r);
    if($mark['mid1']==NULL)
      $mid1="TBA";
    else {
      $mid1=$mark['mid1'];
    }
    if($mark['mid2']==NULL)
      $mid2="TBA";
    else {
      $mid2=$mark['mid2'];
    }
    if($mark['attendance']==NULL)
      $attendance="TBA";
    else {
      $attendance=$mark['attendance'];
    }

    ?>
    <tr>
      <td><?php echo $full_name;?></td>
      <td><?php echo $roll ; ?></td>
      <td><?php echo $mid1 ;?></td>
      <td><?php echo $mid2?></td>
      <td><?php echo $attendance;?></td>
    </tr>
    <?php
  }
  ?>
</tbody>
</table>
  <?php
}
if(isset($_POST['pub_sel']))
{
  $semester=$_POST['pub_sel'];
  $sql="SELECT * FROM current_status WHERE curr_semester='{$semester}'";
  $students=mysqli_query($connection,$sql);
  ?>
  <input hidden value=<?php echo $semester; ?> name="semester">
  <table class="table table-striped">
    <tr>
      <th>Full Name</th>
      <th>Roll</th>
      <?php
        if($semester%2==0)
        {
          ?>
          <th>Viva Voce</th>
          <?php
        }
      ?>
      <th>Verdict</th>
    </tr>
    <tbody>
  <?php
  while($student=mysqli_fetch_assoc($students))
  {
    $user_id=$student['user_id'];
    $sql="SELECT * FROM profile WHERE user_id='{$user_id}'";
    $result=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);
    $full_name=$row['full_name'];
    $roll=$row['roll'];
    ?>
      <tr>
        <td><?php echo $full_name;?></td>
        <td><?php echo $roll;?></td>
        <?php
          if($semester%2==0)
          {
            ?>
            <td><input type="text" name="viva-voce" placeholder="Marks for Viva-Voce"></td>
            <?php
          }
        ?>
        <td><select class="form-control" name=<?php echo $user_id;?>>
          <option value=NULL>-------</option>
          <option value="1">Passed<option>
          <option value="0">Fail<option>
        </select></td>
      </tr>
    <?php
  }
  ?>
</thead>
</table>
  <?php
}
if(isset($_POST['publish']))
{
  $semester=$_POST['semester'];
  $sql="SELECT * FROM subject WHERE subject_name='Viva-Voce' and semester='{$semester}'";
  $result=mysqli_query($connection,$sql);
  $row=mysqli_fetch_assoc($result);
  $viva_id=$row['subject_id'];
  $sql="SELECT * FROM current_status WHERE curr_semester='{$semester}'";
  $students=mysqli_query($connection,$sql);
  while($student=mysqli_fetch_assoc($students))
  {
    $user_id=$student['user_id'];
    if($_POST[$user_id]==1)
    {
      $semester++;
      if($semester==9)
      {
        $sql="DELETE FROM profile WHERE user_id='{$user_id}'";
        mysqli_query($connection,$sql);
        $sql="DELETE FROM result WHERE user_id='{$user_id}'";
        mysqli_query($connection,$sql);
        $sql="DELETE FROM current_status WHERE user_id='{$user_id}'";
        mysqli_query($connection,$sql);
        $sql="DELETE FROM continuous_assessment WHERE user_id='{$user_id}'";
        mysqli_query($connection,$sql);
        $sql="DELETE FROM user_table WHERE user_id='{$user_id}'";
        mysqli_query($connection,$sql);
      }
      else {
        if(isset($_POST['viva-voce']))
        {
          $total=$_POST['viva-voce'];
          $total*=2;
          $gpa=0.0;
          if($total>=80)
          {
            $gpa=4.00;
          }
          else if($total<80 && $total>=75)
          {
            $gpa=3.75;
          }
          else if($total<75 && $total>=70)
          {
            $gpa=3.50;
          }
          else if($total<70 && $total>=65)
          {
            $gpa=3.25;
          }
          else if($total<65 && $total>=60)
          {
            $gpa=3.00;
          }
          else if($total<60 && $total>=55)
          {
            $gpa=2.75;
          }
          else if($total<55 && $total>=50)
          {
            $gpa=2.50;
          }
          else if($total<50 && $total>=45)
          {
            $gpa=2.25;
          }
          else if($total<45 && $total>=40)
          {
            $gpa=2.00;
          }
          else
          {
            $gpa=0.00;
          }

          $sql= "INSERT INTO result (subject_id,user_id,gpa) VALUES('{$viva_id}','{$user_id}','{$gpa}')";
          mysqli_query($connection,$sql);
        }
        $curr_semester=$semester;
        $sql="UPDATE current_status SET curr_semester='{$curr_semester}' WHERE user_id='{$user_id}'";
        mysqli_query($connection,$sql);
        $sql="SELECT * FROM subject WHERE semester='{$curr_semester}'";
        $subjects=mysqli_query($connection,$sql);
        while($subject = mysqli_fetch_assoc($subjects))
        {
          $subject_id=$subject['subject_id'];
          $sql="INSERT INTO continuous_assessment (user_id,subject_id) VALUES('{$user_id}','{$subject_id}')";
          mysqli_query($connection,$sql);
        }
      }
    }
    else if($_POST[$user_id]==0){
      $sql="DELETE FROM continuous_assessment WHERE user_id='{$user_id}'";
      mysqli_query($connection,$sql);

      $curr_semester=$semester;
      $sql="SELECT * FROM subject WHERE semester='{$curr_semester}'";
      $subjects=mysqli_query($connection,$sql);
      while($subject = mysqli_fetch_assoc($subjects))
      {
        $subject_id=$subject['subject_id'];
        $sql="INSERT INTO continuous_assessment (user_id,subject_id) VALUES('{$user_id}','{$subject_id}')";
        mysqli_query($connection,$sql);
      }
    }
    $sql="SELECT * FROM profile WHERE user_id='{$user_id}'";
    $result=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);
    $full_name=$row['full_name'];
    $roll=$row['roll'];
  }
  redirect_to("update_OA.php");
}













if(isset($_POST['final_mark']))
{
  $curr_sem=$_POST['final_mark'];
  $user_id=$_SESSION['user_id'];
  $sql="SELECT * FROM curr_subject WHERE user_id='{$user_id}'";
  $subjects=mysqli_query($connection,$sql);
  ?>
  <select class="form-control" id="choose_subject_final">
    <option data-id=null>-----</option>
  <?php
  while($subject=mysqli_fetch_assoc($subjects))
  {
    $subject_id=$subject['subject_id'];
    $sql="SELECT * FROM subject WHERE subject_id='{$subject_id}'";
    $result=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($result);
    $semester=$row['semester'];
    $subject_name=$row['subject_name'];
    $curr_subject_id="";
    if($semester==$curr_sem)
    {
      $curr_subject_id=$subject_id;
      $curr_subject_name=$subject_name

      ?>
      <option data-id=<?php echo $curr_subject_id;?>><?php echo $curr_subject_name;?></option>
      <?php
    }
  }
  ?>
  </select>
  <script type="text/javascript">
  $('#choose_subject_final').change(
    function()
    {
      console.log("whatevr");
      //alert($(this).find(':selected').data('id'));
      $.ajax({
        type:"POST",
        url:"process.php",
        data:{choose_subject_final:$(this).find(':selected').data('id')},
        success:function(data){
          //console.log(data);
          $('#student_final').html(data);
        }
      });
    }
  );
  </script>
  <?php
}















if(isset($_POST['choose_subject_final']))
{
  $curr_subject_id=$_POST['choose_subject_final'];
  $user_id=$_SESSION['user_id'];

  $sql="SELECT * FROM subject WHERE subject_id='{$curr_subject_id}'";
  $subjects=mysqli_query($connection,$sql);
  $subject=mysqli_fetch_assoc($subjects);
  $curr_sem=$subject['semester'];
  ?>
  <input hidden value=<?php echo $curr_sem; ?> name="semester_final">
  <input hidden value=<?php echo $curr_subject_id; ?> name="subject_id_final">

  <?php
  $sql="SELECT * FROM continuous_assessment WHERE subject_id='{$curr_subject_id}'";
  $result=mysqli_query($connection,$sql);
  ?>
  <table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th>Student's Name</th>
      <th>Roll</th>
      <th>Final</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($row=mysqli_fetch_assoc($result))
  {
    $user_id=$row['user_id'];
    $sql="SELECT * FROM profile WHERE user_id='{$user_id}'";
    $students=mysqli_query($connection,$sql);
    $student=mysqli_fetch_assoc($students);
    $full_name=$student['full_name'];
    $roll=$student['roll'];
    $mid1=$row['mid1'];
    $mid2=$row['mid2'];
    $attendance=$row['attendance'];
    ?>
    <tr>
      <td><?php echo $full_name; ?></td>
      <td><?php echo $roll; ?></td>
          <td><input type="text" name=<?php echo $user_id ; ?> placeholder="Final Marks">
    </tr>
    <?php
  }
  ?>
</tbody>
</table>
  <?php
}



if(isset($_POST['add_final']))
{
  $curr_sem=$_POST['semester_final'];
  $user_id=$_SESSION['user_id'];
  $curr_subject_id=$_POST['subject_id_final'];
  $sql="SELECT * FROM subject WHERE subject_id='{$curr_subject_id}'";
  $result=mysqli_query($connection,$sql);
  $row=mysqli_fetch_assoc($result);
  $credit = $row['credit'];
  //echo $curr_subject_id;
  $sql="SELECT * FROM continuous_assessment WHERE subject_id='{$curr_subject_id}'";
  $result=mysqli_query($connection,$sql);
  while($row=mysqli_fetch_assoc($result))
  {
    //echo $row['user_id']." ".$_POST[$row['user_id']]."<br>";
    $user_id=$row['user_id'];

    $mid1=$row['mid1'];
    $mid2=$row['mid2'];
    $attendance=$row['attendance'];
    $final_mark=$_POST[$user_id];

    $total=$mid1+$mid2+$attendance+$final_mark;
    if($credit==2)
    {
      $total=$total*2;
    }
    $gpa=0.0;
    if($total>=80)
    {
      $gpa=4.00;
    }
    else if($total<80 && $total>=75)
    {
      $gpa=3.75;
    }
    else if($total<75 && $total>=70)
    {
      $gpa=3.50;
    }
    else if($total<70 && $total>=65)
    {
      $gpa=3.25;
    }
    else if($total<65 && $total>=60)
    {
      $gpa=3.00;
    }
    else if($total<60 && $total>=55)
    {
      $gpa=2.75;
    }
    else if($total<55 && $total>=50)
    {
      $gpa=2.50;
    }
    else if($total<50 && $total>=45)
    {
      $gpa=2.25;
    }
    else if($total<45 && $total>=40)
    {
      $gpa=2.00;
    }
    else
    {
      $gpa=0.00;
    }

    $sql= "INSERT INTO result (subject_id,user_id,gpa) VALUES('{$curr_subject_id}','{$user_id}','{$gpa}')";
    mysqli_query($connection,$sql);
  }
  redirect_to("update_T.php");
}

?>
