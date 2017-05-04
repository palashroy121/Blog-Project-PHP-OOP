<?php
include "header.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
  $userRegister = $blog -> user_register_save($_POST);
}

?>
    <div class="container-fluid">
      <div class="row">
      <div class="col-sm-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Recent Post</h3>
          </div>
          <div class="panel-body">
            Panel content
          </div>
        </div>
      </div>

      <div class="col-sm-6 p5" style="background-color: #FFFFFF;">
        <h3>Registration Form</h3>
        <hr/>
          <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Full Name</label>
              <div class="col-sm-9">
                <input type="text" name="name" class="form-control" id="inputEmail3">
                <p>
                  <?php
                    if(isset($userRegister)){
                      echo $userRegister['name'];
                    }
                  ?>
                </p>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">User Name</label>
              <div class="col-sm-9">
                <input type="text" name="user_name" class="form-control" id="inputEmail3">
                <p>
                  <?php
                    if(isset($userRegister)){
                      echo $userRegister['user_name'];
                    }
                  ?>
                </p>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
              <div class="col-sm-9">
                <input type="text" name="address" class="form-control" id="inputEmail3">
                <p>
                  <?php
                    if(isset($userRegister)){
                      echo $userRegister['address'];
                    }
                  ?>
                </p>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Image</label>
              <div class="col-sm-9">
                <input type="file" name="image" id="inputEmail3">
                <p>
                  <?php
                    if(isset($userRegister)){
                      echo $userRegister['image'];
                    }
                  ?>
                </p>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Email Address</label>
              <div class="col-sm-9">
                <input type="email" name="email" class="form-control" id="inputEmail3">
                <p>
                  <?php
                    if(isset($userRegister)){
                      echo $userRegister['email'];
                    }
                  ?>
                </p>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
              <div class="col-sm-9">
                <input type="password" name="password" class="form-control" id="inputEmail3">
                <p>
                  <?php
                    if(isset($userRegister)){
                      echo $userRegister['password'];
                    }
                  ?>
                </p>
              </div>
            </div>
            <input class="btn btn-primary pull-right" type="submit" name="register">
          </form>
        </div>

        <div class="col-sm-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Top 5 Post</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <blockquote>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
  <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
</blockquote>
          </div>
        </div>

      </div>
    </div>
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>