<?php
include("header.php");
if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1)
{
?>


  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#midtermMarks">Add midterm marks</button>

<!-- Modal -->
<div id="midtermMarks" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add midterm marks</h4>
      </div>
      <div class="modal-body">
        Concerned Semester :
      <select class="form-control" id="choose_semester">
        <option data-id=NULL value=NULL>-------</option>
        <option data-id='1' value='1'>1st</option>
        <option data-id='2' value='2'>2nd</option>
        <option data-id='3' value='3'>3rd</option>
        <option data-id='4' value='4'>4th</option>
        <option data-id='5' value='5'>5th</option>
        <option data-id='6' value='6'>6th</option>
        <option data-id='7' value='7'>7th</option>
        <option data-id='8' value='8'>8th</option>
      </select>
        <div id="subject"></div>
        <form class="form-horizontal" role="form" action="process.php" method="post">

        <div id="student"></div>
        <!--eikhane ekta table dibo jekhane subject er jonno prottek student er midterm er marks thakbe!-->
        <br/>
        <input type = "submit" value = "submit" class="btn btn-info btn-md" name="add_mid">
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#finalMarks">Add final marks</button>

  <!-- Modal -->
  <div id="finalMarks" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add final marks</h4>
        </div>
        <div class="modal-body">
          Concerned Semester :
        <select class="form-control" id="final">
          <option data-id=NULL value=NULL>-------</option>
          <option data-id='1' value='1'>1st</option>
          <option data-id='2' value='2'>2nd</option>
          <option data-id='3' value='3'>3rd</option>
          <option data-id='4' value='4'>4th</option>
          <option data-id='5' value='5'>5th</option>
          <option data-id='6' value='6'>6th</option>
          <option data-id='7' value='7'>7th</option>
          <option data-id='8' value='8'>8th</option>
        </select>
          <div id="subject_final"></div>
          <form class="form-horizontal" role="form" action="process.php" method="post">

          <div id="student_final"></div>
          <!--eikhane ekta table dibo jekhane subject er jonno prottek student er midterm er marks thakbe!-->
          <br/>
          <input type = "submit" value = "submit" class="btn btn-info btn-md" name="add_final">
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <script type="text/javascript">
  $('#choose_semester').change(
    function()
    {
      //console.log("whatevr");
      //alert($(this).find(':selected').data('id'));
      $.ajax({
        type:"POST",
        url:"process.php",
        data:{mid_mark:$(this).find(':selected').data('id')},
        success:function(data){
          //console.log(data);
          $('#subject').html(data);
        }
      });
    }
  );
  </script>
  <script type="text/javascript">
  $('#final').change(
    function()
    {
      //console.log("whatevr");
      //alert($(this).find(':selected').data('id'));
      $.ajax({
        type:"POST",
        url:"process.php",
        data:{final_mark:$(this).find(':selected').data('id')},
        success:function(data){
          //console.log(data);
          $('#subject_final').html(data);
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
