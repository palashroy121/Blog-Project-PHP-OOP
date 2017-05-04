<?php
include "header.php";

$catName = 'php';

if(isset($_GET['page'])){
  $page = $_GET['page'];
}
else{
  $page = 0;
}

$CatPost = $blog -> selectCatPost($catName, $page);

$cat_pagi = $blog -> cat_pagination($catName);

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
          if($CatPost){
            foreach ($CatPost as $value) {
            
        ?>
          <div class="media p5" style="background-color: #FFFFFF; padding-top: 15px;">
             <h4 class="media-heading heading">
             <a href="details.php?id=<?php echo $value['post_id']; ?>"><?php echo $value['post_title']; ?></a></h4>
            <hr/>
            <p class="p3 small">Author <?php echo $value['name']; ?> | Published <?php echo $value['created_at']; ?> | Comments (0)</p>
            <hr/ class="p4">
            <div class="media-body">
              <p class="text"><?php echo substr($value['post'], 0, 150);?> (<a class="read-mor" href="details.php?id=<?php echo $value['post_id']; ?>">Read More...</a>)</p>
            </div>
          </div>
          <?php
              }
            }
            else{
              echo '<p class="well text-danger">Data Not Found!</p>';
            }
          ?>

          <nav aria-label="Page navigation">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php 
                if($cat_pagi){
                  for($b=1; $b<=$cat_pagi; $b++){ ?>
                    <li><a href="php.php?page=<?php echo $b; ?>"><?php echo $b; ?></a></li>
                  <?php } } ?>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>

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