<?php
include("header.php");
?>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#subjectModal">Choose Subject</button>

<!-- Modal -->
<div id="subjectModal" class="modal fade" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">
      <form>
        Please choose the course name :
      <select>
        <option>1st year</option>
      </select>
      <!--eikhane database theke subject anbo , appropriate year er jonno!-->
      <select>
        <option>2nd year</option>
      </select>
      <!--eikhane database theke subject anbo , appropriate year er jonno!-->
      <br/>
      <br/>
      <select>
        <option>3rd year</option>
      </select>
      <!--eikhane database theke subject anbo , appropriate year er jonno!-->
      <select>
        <option>4th year</option>
      </select>
      <!--eikhane database theke subject anbo , appropriate year er jonno!-->
      <br/>
      <br/>
      <input type = "submit" value = "submit">
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
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#midtermMarks">Add midterm marks</button>

<!-- Modal -->
<div id="midtermMarks" class="modal fade" role="dialog">
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
        <!--eikhane ekta table dibo jekhane subject er jonno prottek student er midterm er marks thakbe!-->
        <br/>
        <input type = "submit" value = "submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add final marks</button>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <table width = "100%">
            <tr>
              <th>Name</th>
              <th>Marks</th>
              <th>Grade point</th>
              <th>Grade</th>
            </tr>
            <tr>
              <td>student1</td>
              <td>75</td>
              <td>3.75 </td>
              <td>A</td>
            </tr>
            <tr>
              <td>student2</td>
              <td>70</td>
              <td>3.50</td>
              <td>A-</td>
            </tr>
            <tr>
              <td>student3</td>
              <td>80</td>
              <td>4.00</td>
              <td>A+</td>
            </tr>
            <tr>
              <td>student4</td>
              <td>60</td>
              <td>3.00</td>
              <td>B</td>
            </tr>
            <tr>
              <td>student5</td>
              <td>67</td>
              <td>3.25</td>
              <td>B+</td>
            </tr>
          </table>
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
