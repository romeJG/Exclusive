<?php
$pageTitle='members';
session_start();
if(isset($_SESSION['username'])){
   include 'init.php';
     
   if(isset($_GET['do'])){
    $do= $_GET['do'];
    
    }else{
        $do='manage';

    }
    if($do =='manage'){
    $stmt = $con->prepare("SELECT comment.*,items.name AS itemsname,users.username FROM comment  
    INNER JOIN items ON items.id = comment.item_id
    INNER JOIN users ON users.userID = comment.user_id");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    ?>

    <h1 class="text-center">Add Comment</h1>
    <div class="container">
    <div class="table-responsive">
  <table class="main-table text-center table table-bordered">
    <tr class="table-dark">
        <td>#ID</td>
        <td>Comment</td>
        <td>comment_date</td>
        <td>item name</td>
        <td>username</td>
        <td>control</td>
    </tr>
    <?php
    foreach($rows as $row){
    echo'<tr>';
            echo'<td>' . $row['c_id'] .'</td>'; 
            echo'<td>' . $row['comment'] .'</td>'; 
            echo'<td>' . $row['comment_date'] .'</td>'; 
            echo'<td>' . $row['itemsname'] .'</td>'; 
            echo'<td>' . $row['username'] .'</td>'; 
            echo"<td>
            <a href='comment.php?do=edit&userID=". $row['c_id'] ."' class='btn btn-success'>Edit</a>
            <a href='comment.php?do=Delete&userID=". $row['c_id'] ."' class='btn btn-danger confirm'>Delete</a>";
            if($row['status'] == 0){
             echo "<a href='comment.php?do=active&userID=". $row['c_id'] ."' class='btn btn-info'>Active</a>";
            }

           echo "</td>"; 

    echo'</tr>';
    }


    ?>

    
  </table>
</div>


   <?php }elseif($do =='edit'){

      $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;


      $stmt=$con->prepare('SELECT * FROM comment WHERE c_id = ? LIMIT 1');
      $stmt -> execute(array($user));
      $row=$stmt->fetch();
      $count= $stmt->rowcount();
    if($count > 0){?>  
        <h1 class="text-center">Edit comment</h1>
        <div class="container">
        <form class="form-horizontal" action="?do=Update" method="POST">
        <div class="form-group">
            <input type="hidden" name="c_id" value="<?php echo $user ?>">
    <label for="exampleFormControlTextarea1"><?php echo lang('comment')?></label>
    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                    <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Edit comment"  class="btn btn-outline-primary">
            </div>
                    </div>
                 </form>
                     </div>

        
    <?php
    }else{
        echo 'error';
    }
   
    }elseif($do =='Update'){
        echo'<h1 class="text-center">Update comment</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $id = $_POST['c_id'];
            $comment = $_POST['comment'];
            
            //validate the form;
            $formErrors=array();
            if(empty($comment)){
                $formErrors[] = '<div class="alert alert-danger">you must put the username </div>';
            }
            foreach($formErrors as $error){
                echo $error . '<br/>';
            }
            // no error Update;
            if(empty($formErrors)){
            $stmt=$con->prepare("UPDATE comment SET comment = ? , c_id = ?");
            $stmt->execute(array($comment , $id));
            if($stmt->rowcount() > 0){
                $themassge=  'update your information is done!';
                up($themassge, 2);
            }
                }

        }else{

             $errormassages = 'sorry you cant browes this page';
             up($errormassages, 2);
        }
        echo "</div>";

        
    

    }elseif($do =='Delete'){
        echo'<h1 class="text-center">Delete comment</h1>';
        echo "<div class='container'>";
        $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;

  
        $count= checkItem('c_id', 'comment', $user);
      if($count > 0){
        $stmt=$con->prepare('DELETE FROM comment WHERE c_id = :zuser');
        $stmt->execute(array(
            ':zuser' => $user
        ));
        $themassge= 'Delete your information is done!';
        up($themassge, 4); 

    }
        
        }elseif($do =='active'){
            echo'<h1 class="text-center">Activate members</h1>';
            echo "<div class='container'>";
            $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;
      
            $count= checkItem('c_id', 'comment', $user);
          if($count > 0){
            $stmt=$con->prepare('UPDATE comment SET status = 1 WHERE c_id = ?');
            $stmt->execute(array($user));
            $themassge= 'Activate your information is done!';
            up($themassge, 4); 
        }
    }

    include  $tpl . 'footer.php';
}else{
    header('Location:index.php');
    
    exit();

}


?>