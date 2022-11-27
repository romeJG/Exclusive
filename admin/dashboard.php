<?php
session_start();
if(isset($_SESSION['username'])){
$pageTitle='dashborde';
   include 'init.php';
    
?>
    <div class="container home-stats text-center">
        <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                <div class="stat st-members">
                <i class="far fa-address-card"></i>
                <?php echo lang('total MEMBERS') ?>
                    <span><a href="#"><?php $stmt2= $con->prepare("SELECT COUNT(userID) FROM users");
    $stmt2->execute();
    echo $stmt2->fetchColumn();
                    ?></a></span>
                      <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="members.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-md-3">
                <div class="stat st-pending">
                <i class="fas fa-pause"></i>
                <?php echo lang('pending MEMBERS') ?>
                    <span><a href="#"><?php $stmt2= $con->prepare("SELECT COUNT(userID) FROM users WHERE regStatus = 0");
    $stmt2->execute();
    echo $stmt2->fetchColumn();
  ?>  </a></span>
    <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="members.php?do=pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-md-3">
                <div class="stat st-items">
                <i class="fas fa-users"></i>
                    <?php echo lang('total item')?>
                    <span><a href="#"><?php $stmt2= $con->prepare("SELECT COUNT(id) FROM items");
    $stmt2->execute();
    echo $stmt2->fetchColumn();
    ?>
    </a>
    </span>
    <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="items.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-md-3">
                <div class="stat st-comments">
                <i class="fas fa-comments"></i>
                    <?php echo lang('total comments')?>
                    <span><a href="#"><?php $stmt2= $con->prepare("SELECT COUNT(c_id ) FROM comment");
    $stmt2->execute();
    echo $stmt2->fetchColumn();
    ?>
    </span>
                    <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="comment.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
                </div>

    </div>
    <div class="container latest">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-users"></i> <?php echo lang('latest registerd users')?>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled latest-users">
                            <?php
                                          $stmt = $con->prepare("SELECT * FROM users LIMIT 2");
                                          $stmt->execute();
                                          $rows= $stmt->fetchAll();
                                          ?>
                                      
                                         
                                          <div class="container">
                                          <div class="table-responsive">
                                        <table class="main-table text-center table table-bordered">
                                          <tr class="table-">
                                              <td>#ID</td>
                                              <td>name</td>
                                              <td>control</td>
                                          </tr>
                                          <?php
                                          foreach($rows as $row){
                                          echo'<tr>';
                                                  echo'<td>' . $row['userID'] .'</td>'; 
                                                  echo'<td>' . $row['username'] .'</td>'; 
                                                  echo"<td>
                                                  <a href='items.php?do=edit&userID=". $row['userID'] ."' class='btn btn-success confirm'>Edit</a>
                                                  <a href='items.php?do=Delete&userID=". $row['userID'] ."' class='btn btn-danger confirm'>Delete</a>";
                                            
                                          echo "</td>"; 
                                          echo'</tr>';
                                      }
                            ?>
                            </ul>
                </div>
            </div>
         </div>
        </div>

<?php
    include  $tpl . 'footer.php';
}else{
    header('Location:index.php');
    
    exit();
}
?>