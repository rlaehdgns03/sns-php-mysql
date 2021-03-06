<?php
require("../lib/permission.php");
require("../lib/database.php");
require("../view/top.php");
?>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
    <div class="container">
      <a class="navbar-brand" href="main_feed.php">SNS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="user-image" href="../profile/profile.php?no=<?=$_SESSION['no']?>">
              <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fkinimage.naver.net%2F20200818_247%2F1597730197036S5pFh_JPEG%2F1597730196729.jpg&type=sc960_832" alt="user-img" class="rounded-circle mt-1 ml-3 mr-2" width="30" height="30">
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../login/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- //Navigation -->

  <!-- Page Section -->
  <div class="container-fluid gedf-wrapper">
    <div class="row">
        <div class="col-md-3"></div>
        <!-- Post Section -->
        <div class="col-md-6 gedf-main">
            <!-- Post Upload Section -->
            <div class="card gedf-card">             
              <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">
                            게시물 작성    
                          </a>
                      </li>
                  </ul>
              </div>
              <form action="main_create.php" method="post">
              <input type="hidden" name="no" value=<?=$_SESSION['no']?>>
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                      <div class="form-group">
                        <label class="sr-only" for="message">post</label>                                
                        <textarea class="form-control" id="message" rows="3" name="description" placeholder="게시물을 작성해주세요."></textarea>
                      </div>
                    </div>
                  </div>
                    <div class="btn-toolbar justify-content-between">
                        <div class="btn-group">
                            <input type="submit" class="btn btn-primary" value="업로드">
                        </div>
                    </div>
              </form>
            </div>
          </div>
            <!-- //Post Upload Section -->

        <!-- Post -->
        <?php
          $sql = "SELECT topic.no, description, created, user_no, name, likes FROM topic LEFT JOIN user ON topic.user_no = user.no ORDER BY created DESC";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_array($result)){
        ?> 
        <div class="card gedf-card">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
            <?php
              require("../view/post_header.php");
            ?>
              <div class="btn-group">
                <?php

                  if($row['name'] === $_SESSION['name']){

                ?>
                <a href="main_update.php?no=<?=$row['no']?>" class="btn btn-primary">수정</a> 
                <?php
                  }
                ?>
              </div>
            </div>
          </div>

          <div class="card-body">
            <p class="card-text"><?=$row['description']?></p>
          </div>

          <div class="card-footer">
          
          <?php 
					$results = mysqli_query($conn, "SELECT * FROM likes WHERE user_no=".$_SESSION['no']." AND description_no=".$row['no']."");
        
					if (mysqli_num_rows($results) === 1 ) { ?>
	
            <a href="./main_likes.php?likes=liked&no=<?=$row['no']?>" class="card-link"><i class="fa fa-heart"></i></a>
            <a href="./main_comments.php?likes=liked&no=<?=$row['no']?>" class="card-link"><i class="fa fa-comment-o"></i></a>

          <?php
            }else {
          ?>
    
            <a href="./main_likes.php?likes=unliked&no=<?=$row['no']?>" class="card-link"><i class="fa fa-heart-o"></i></a>
            <a href="./main_comments.php?likes=unliked&no=<?=$row['no']?>" class="card-link"><i class="fa fa-comment-o"></i></a>

          <?php
            }
          ?>
          
					<div class="">좋아요 <?=$row['likes']?>개</div>
            
          </div>
        </div>
        <?php
          }
        ?>
        <!-- //Post-->
        </div>
        <!-- //Post Section -->
      </div>
    </div>
  <!-- //Page Section -->
<?php
require("../view/bottom.php");
?>