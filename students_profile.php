<?php
include("header.php");
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
            <form>
              <form>
                Previous semester :
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
              <!--eikhane ekta table thakbe jeitay database er result table theke ekta particular semester er result-->
            </br>
              <input type = "submit" value = "Go">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>
</br>
</br>
  <div class="table-responsive">
   <table class="table">
     <tr>
       <th>Course title</th>
       <th>Mid1</th>
       <th>Mid2</th>
       <th>Attendance</th>
     </tr>
     <tr>
       <td>Peripheral Interfacing</td>
       <td>8</td>
       <td>7</td>
       <td>9</td>
     </tr>
     <tr>
       <td>Internet and Web Programming</td>
       <td>10</td>
       <td>9</td>
       <td>10</td>
     </tr>
     <tr>
       <td>Graphics and Multimedia</td>
       <td>17</td>
       <td>14</td>
       <td>10</td>
     </tr>
     <tr>
       <td>Cryptography and network security</td>
       <td>4</td>
       <td>3</td>
       <td>10</td>
     </tr>
   </table>
 </div>

    <?php
    include("footer.php");
     ?>
