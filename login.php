<?php
include "header.php";

Session::sessionLoginCheck();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    $userLogin = $blog -> check_login($_POST);
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
        <h3>Login Form</h3>
        <hr/>
          <form class="form-horizontal" action="" method="post">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                      <input type="text" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                      <p>
                        <?php
                          if(isset($userLogin)){
                            echo $userLogin['email'];
                          }
                        ?>
                      </p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
					             <p>
                        <?php
                          if(isset($userLogin)){
                            echo $userLogin['password'];
                          }
                        ?>
                      </p>
                    </div>
                  </div>
                  <input class="btn btn-primary pull-right" type="submit" name="login">
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