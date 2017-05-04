<?php
include "lib/Blog.php";

$blog = new Blog();

$filepath = realpath(dirname(__FILE__));
  include_once $filepath.'/lib/Session.php';
  Session::init();
  $id = Session::get("id");
  $userlogin = Session::get("login");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){
    $savePost = $blog -> save_post($_POST, $id);
  }

$catView = $blog -> selectCat();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog | </title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <link href="bootstrap/css/style.css" rel="stylesheet">
  </head>

  <?php
    if(isset($_GET['action']) && $_GET['action'] == "logout") {
      Session::destroy();
    }
  ?>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php
            if($catView){
              foreach ($catView as $value) {
            ?>
            <li><a class="menu" href="<?php echo $value['cat_name'] . '.php'?>"><?php echo $value['cat_name']; ?></a></li>
            <?php
            }
            }
            ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          
          <?php
              
              if($userlogin == false){
            ?>
			
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <?php
              }
              else{
            ?>
            <li><a href="" data-toggle="modal" data-target="#myModal">New Post</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php $name=Session::get('name'); echo $name;?><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php">Profile</a></li>
                <li><a href="change_password.php">Change Password</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="?action=logout">Logout</a></li>
              </ul>
            </li>
            <?php
              }
            ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Post </h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <form class="form-horizontal" action="" method="post">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Category</label>
                    <div class="col-sm-9">
                      <select name="cat_id" class="form-control" id="cat_id">
                        <option>--Select Category--</option>
                        <?php
                        if($catView){
                          foreach ($catView as $value) {                     
                        ?>
                        <option value="<?php echo $value['cat_id']; ?>"><?php echo $value['cat_name']; ?></option>
                        <?php }} ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Post Title</label>
                    <div class="col-sm-9">
                      <input type="text" name="post_title" class="form-control" id="post_title" placeholder="Post Title">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Post</label>
                    <div class="col-sm-9">
                      <textarea name="post" rows="4" class="form-control" id="post"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">
                      <input type="radio" name="status" value="1"> View
                      <input type="radio" name="status" value="0"> Draft
                    </div>
                  </div>
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Modal -->