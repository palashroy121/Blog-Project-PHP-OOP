<?php
include "header.php";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])){
    $updatePass = $blog -> updatePassword($id, $_POST);
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
        <div class="col-sm-6" style="background-color: #FFFFFF;">
        <p>
        <?php
        if(isset($msg)){
          echo $msg;
          }
          ?>
          </p>
          <h3>User Info</h3>
          <hr/>
          <form action="" method="post">
            <div class="form-group">
              <label for="old_password">Old Password</label>
              <input type="password" id="old_password" name="old_password" class="form-control">
              <p>
                <?php
                  if(isset($updatePass)){
                    echo $updatePass['old_password'];
                  }
                ?>
              </p>
            </div>

            <div class="form-group">
              <label for="password">New Password</label>
              <input type="password" id="password" name="password" class="form-control">
              <p>
                <?php
                  if(isset($updatePass)){
                    echo $updatePass['new_password'];
                  }
                ?>
              </p>
            </div>

            <button type="submit" name="updatepass" class="btn btn-success">Update</button>
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

      </div>
    </div>
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>