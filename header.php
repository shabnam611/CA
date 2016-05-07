<?php

  include_once("error.php");
  include_once("session.php");


?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="stylesheet.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">


  <title>home</title>
</head>
<body>
  <h1>Course Assistant</h1>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="results.php">Result</a></li>
          <li><a href="students_profile.php">Profile</a></li>
          <li><a href="other.php">Other</a></li>
        </ul>
        <?php
        if(!confirm_logged_in()){
        ?>
        <ul class="nav navbar-nav navbar-right">
          <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#SignupModal">Sign up</button>

          <!-- Modal -->
          <div id="SignupModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Thank you for signing up: </h4>
                </div>
                <div class="modal-body">
                  <div class = "loginForm">
                    <form role="form" action="signUp.php" method="post">
                      <div class="form-group">
                        <input id="username" name="username" class='form-control' type= "text" placeholder = "name" required>
                      </div>
                      <div class="form-group">
                        <input id="passwd" name="passwd" class='form-control' type= "password" placeholder = "password" required>
                      </div>
                      <div class="form-group">
                        <input id="conf_pass" name="conf_pass"class='form-control' type= "password" placeholder = "confirm password" required>
                      </div>

                      <input class = "btn-info" name="signup"class=" btn btn-default" type= "submit" value="SignUp"><br>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
          <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#LoginModal">Login</button>

          <!-- Modal -->
          <div id="LoginModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Welcome back!</h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="login.php" method="post">
                    <input type= "text" placeholder = "name" name="username" required><br>
                    <br>
                    <input type= "password" placeholder = "password" name="password" required><br>
                    <br>
                    <input type= "submit" value="log in" class="btn btn-info btn-md" name="login"><br>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
        </ul>

        <?php
        }
        else{

          ?>

          <ul class="nav navbar-nav navbar-right">
        <form role="form" action="login.php" method="post">
          <button  class="btn btn-info btn-md" name="logout">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </button>
        </form>
          </ul>
          <?php
        }
        ?>
      </div>
    </div>
  </nav>
