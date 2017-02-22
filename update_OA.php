<?php
include_once("error.php");
include_once("connection.php");
include_once("form_functions.php");
include_once("functions.php");
include_once("session.php");
include("header.php");
if(isset($_SESSION['user_type']) && $_SESSION['user_type']==2)
{
?>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#approveUser">Approve User</button>

<!-- Modal -->
<div id="approveUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Approve User</h4>
      </div>

      <div class="modal-body">
        <form role="form" action="process.php" method="post">
          <?php
          $sql = "SELECT * FROM user_table WHERE user_type IS NULL";
          $result = mysqli_query($connection , $sql);
          while($row = mysqli_fetch_assoc($result)){
            ?>
            <label name = <?php echo $row["user_id"]; ?> >
              <?php
              echo $row["user_name"];
              ?>
            </label>
            <select  class="form-control"name = <?php echo $row['user_id'];?>>
              <option value=NULL>-------</option>
              <option value="0">student</option>
              <option value="1">teacher</option>
              <option value="2">office_assistant</option>
              <option value="-1">invalid</option>
            </select>
          </br>
          <?php
        }
        ?>
        <button type="submit" class="btn btn-info btn-md" name = "approve">Approve</button>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#uploadNotice">Upload notice</button>
<div id="uploadNotice" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload notice</h4>
      </div>
      <div class="modal-body">
        <form role="form" action="process.php" method="post">
          <textarea class="form-control" name="description"></textarea>
          <!--eikhane ekta text field dibo jeita home page er notice er sathe connected thakbe , eikhane likhle , notice e chole jabe!-->
          <input type = "submit" value = "submit" name="notice">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#assignSubject">Assign Subject</button>
<div id="assignSubject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Subject</h4>
        </div>
        <div class="modal-body">
          Concerned semester :
          <select class="form-control" name="semester" id="semester">
            <option value=NULL>-------</option>
            <option data-id='1'>1st</option>
            <option data-id='2'>2nd</option>
            <option data-id='3'>3rd</option>
            <option data-id='4'>4th</option>
            <option data-id='5'>5th</option>
            <option data-id='6'>6th</option>
            <option data-id='7'>7th</option>
            <option data-id='8'>8th</option>
          </select>
          <form role="form" action="process.php" method="POST">

            <br>
            <div id="subject"></div>
            <input type="submit" class="btn btn-info btn-md" value="Assign" name="assign">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#publishResult">Publish Result</button>
  <div id="publishResult" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Publish Result</h4>
          </div>
          <div class="modal-body">
            Concerned semester :
            <select class="form-control" name="pub_sel" id="pub_sel">
              <option value=NULL>-------</option>
              <option data-id='1'>1st</option>
              <option data-id='2'>2nd</option>
              <option data-id='3'>3rd</option>
              <option data-id='4'>4th</option>
              <option data-id='5'>5th</option>
              <option data-id='6'>6th</option>
              <option data-id='7'>7th</option>
              <option data-id='8'>8th</option>
            </select>
            <form role="form" action="process.php" method="POST">

              <br>
              <div id="publish_sel"></div>
              <input type="submit" class="btn btn-info btn-md" value="Publish" name="publish">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  <script type="text/javascript">
  $('select').change(
    function()
    {
      //console.log("whatevr");
      //alert($(this).find(':selected').data('id'));
      $.ajax({
        type:"POST",
        url:"process.php",
        data:{semester:$(this).find(':selected').data('id')},
        success:function(data){
          console.log(data);
          $('#subject').html(data);
        }
      });
    }
  );
  </script>
  <script type="text/javascript">
  $('#pub_sel').change(
    function()
    {
      //console.log("whatevr");
      //alert($(this).find(':selected').data('id'));
      $.ajax({
        type:"POST",
        url:"process.php",
        data:{pub_sel:$(this).find(':selected').data('id')},
        success:function(data){
          console.log(data);
          $('#publish_sel').html(data);
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
