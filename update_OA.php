<?php
include_once("error.php");
include_once("connection.php");
include_once("form_functions.php");
include_once("functions.php");
include_once("session.php");
include("header.php");
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
        <h4 class="modal-title">Modal Header</h4>
      </div>

      <div class="modal-body">
        <form role="form" action="update.php" method="post">
          <?php
          $sql = "SELECT * FROM user_table WHERE user_type IS NULL";
          $result = mysqli_query($connection , $sql);
          while($row = mysqli_fetch_assoc($result)){
            ?>
            <label name = <?phpecho "$row["user_id"]"; ?> >
              <?php
              echo $row["user_name"];
              ?>
            </label>
            <select name = <?php echo $row['user_id'];?>>
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
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <form>
          Concerned Batch :
          <select>
            <option>1st</option>
            <option>2nd</option>
            <option>3rd</option>
            <option>4th</option>
            <option>5th</option>
            <option>6th</option>
            <option>7th</option>
            <option>8th</option>
          </select>
          <!--eikhane ekta text field dibo jeita home page er notice er sathe connected thakbe , eikhane likhle , notice e chole jabe!-->
          <input type = "submit" value = "submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#assignSubject">Assign Subject</button>
<div id="assignSubject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <form>

          Concerned semester :
          <select>
            <option>1st</option>
            <option>2nd</option>
            <option>3rd</option>
            <option>4th</option>
            <option>5th</option>
            <option>6th</option>
            <option>7th</option>
            <option>8th</option>
          </select>
          <table>
            <!--bring subject name from databse according to semester-->
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>
