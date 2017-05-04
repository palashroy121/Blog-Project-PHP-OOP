<?php
include "header.php";
$viewUser = $blog -> view_user($id);
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
          <h3>User Info</h3>
          <hr/>
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td>Name</td>
                <td>User Name</td>
                <td>Address</td>
                <td>Email Address</td>
                <td>Profile Image</td>
              </tr>
              <tr>
                <?php
                if($viewUser){
                  foreach($viewUser as $value){
                ?>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['user_name']; ?></td>
                <td><?php echo $value['address']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td><img src="image/<?php echo $value['image'];?>" width="40" height="50"/></td>
                <?php
                  }
                }
                ?>
              </tr>
            </table>
          </div>
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