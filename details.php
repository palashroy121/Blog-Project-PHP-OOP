<?php
include "header.php";

$Sid = $_GET['id'];

$ViewBlog = $blog -> selectBlogById($Sid);

$userlogin1 = Session::get("login");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveComment'])){
	if($userlogin1 == false){
		header("Location: login.php");
	}
  else{
		$saveComment = $blog -> save_comment($_POST, $id);
	}
}

$viewComment = $blog->view_comment($Sid);

$RecentPost = $blog -> selectRecentPost();

$topPost = $blog -> topHitPost();

?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Recent Post</h3>
            </div>
              <?php
                if($RecentPost){
                  foreach ($RecentPost as $value) {
                    echo '<a href="details.php?id='. $value['post_id'] .'" class="list-group-item"><span class="number"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>'.$value['post_title'].'</a>';
                  }
                }
              ?>
          </div>
        </div>
        <div class="col-sm-6">
        <?php
          if($ViewBlog){
            foreach ($ViewBlog as $value) {
            
        ?>
          <div class="media p5" style="background-color: #FFFFFF; padding-top: 15px;">
            <h4 class="media-heading heading">
             <?php echo $value['post_title']; ?></h4>
            <hr/>
            <p class="p3 small">Author <?php echo $value['name']; ?> | Published <?php echo $value['created_at']; ?> | Comments (0)</p>
            <hr/ class="p4">
            <div class="media-body">
              <p class="text"><?php echo $value['post'];?></p>
            </div>
            
            <button class="btn btn-default" data-toggle="modal" data-target="#commentModal-<?php echo $value['post_id'];?>">Comment</button>
            <hr/>

            <?php
              if($viewComment){
                foreach($viewComment as $value1){
                  ?>
                    <p class="com-text"><i class="fa fa-comments" aria-hidden="true"></i> 
                      <?php echo $value1['comment']; ?>
                    </p>
            <?php
                }
              }
            ?>
          </div>
          <!-- Modal -->
        <div class="modal fade" id="commentModal-<?php echo $value['post_id'];?>" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Comment </h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <form class="form-horizontal" action="" method="post">
                      <input type="hidden" name="post_id" value="<?php echo $value['post_id'];?>">
                      <div class="form-group">
                        <div class="col-sm-12">
                          <textarea name="comment" rows="4" class="form-control" id="post"></textarea>
                        </div>
                      </div>
                      
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="saveComment">Save</button>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Modal -->
          <?php
              }
            }
            else{
              echo "<p>No Data Found!</p>";
            }
          ?>
        </div>

        <div class="col-sm-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Top 5 Post</h3>
            </div>
            <div class="panel-body">
              <div class="list-group">
                <?php
                  if($topPost){
                    $i = 1;
          foreach ($topPost as $value) {
                      echo '<a href="details.php?id='. $value['post_id'] .'" class="list-group-item"><span class="number">'.$i.'</span>'. $value['post_title'].'</a>';
          $i++;
                    }
                  }
                ?>
              </div>
            </div>
        </div>
      
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Recent Post</h3>
          </div>
            <?php
              if($RecentPost){
                $i = 1;
                foreach ($RecentPost as $value) {
                  echo '<a href="details.php?id='. $value['post_id'] .'" class="list-group-item"><span class="number">'.$i.'</span>'.$value['post_title'].'</a>';
                  $i++;
                }
              }
            ?>
          </div>
        </div>

      </div>
    </div>
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>