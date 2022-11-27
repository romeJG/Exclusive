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
    $stmt = $con->prepare("SELECT * FROM users where GroupID != 1");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    ?>

    <h1 class="text-center">Add new members</h1>
    <div class="container">
    <div class="table-responsive">
  <table class="main-table text-center table table-bordered">
    <tr class="table-dark">
        <td>#ID</td>
        <td>username</td>
        <td>Email</td>
        <td>Fullname</td>
        <td>registerd Date</td>
        <td>control</td>
    </tr>
    <?php
    foreach($rows as $row){
    echo'<tr>';
            echo'<td>' . $row['userID'] .'</td>'; 
            echo'<td>' . $row['username'] .'</td>'; 
            echo'<td>' . $row['Email'] .'</td>'; 
            echo'<td>' . $row['Fullname'] .'</td>'; 
            echo'<td>' . $row['Date'] .'</td>'; 
            echo"<td>
            <a href='members.php?do=edit&userID=". $row['userID'] ."' class='btn btn-success'>Edit</a>
            <a href='members.php?do=Delete&userID=". $row['userID'] ."' class='btn btn-danger confirm'>Delete</a>";
            if($row['regStatus'] == 0){
             echo "<a href='members.php?do=active&userID=". $row['userID'] ."' class='btn btn-info'>Active</a>";
            }

           echo "</td>"; 

    echo'</tr>';
    }


    ?>

    
  </table>
</div>
     <a class="btn btn-primary" href="members.php?do=Add"><i class="fas fa-plus"></i> Add new members</a>

  <?php  }elseif($do == 'Add'){//Add page;?>
    
    <h1 class="text-center">Add new members</h1>
        <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('USERNAME')?></label>
                <div class="col-sm-10">
                    <input type="text" name="Username"  class="form-control" placeholder=" min 4 char -> max 10 char" /> 
            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('PASSWORD')?></label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control"  autocomplete="new-password" placeholder="put your new password" />

            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('EMAIL')?></label>
                <div class="col-sm-10">
                    <input type="text" name="email"  class="form-control" placeholder="put your new email"/>
            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('FULLNAME')?></label>
                <div class="col-sm-10">
                    <input type="text" name="fullname"  class="form-control" placeholder="put your fullname"/>
            </div>
                    </div>
                    <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Add member"  class="btn btn-outline-primary">
            </div>
                    </div>
                 </form>
                     </div>


   <?php }elseif($do =='edit'){

      $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;


      $stmt=$con->prepare('SELECT * FROM users WHERE userID = ? LIMIT 1');
      $stmt -> execute(array($user));
      $row=$stmt->fetch();
      $count= $stmt->rowcount();
    if($count > 0){?> 
        <h1 class="text-center">Edit members</h1>
        <div class="container">
        <form class="form-horizontal" action="?do=Update" method="POST">
            <input type="hidden" name="userid" value="<?php echo $user ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('USERNAME')?></label>
                <div class="col-sm-10">
                    <input type="text" name="Username" value='<?php echo $row['username']?>' class="form-control"/>
            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('PASSWORD')?></label>
                <div class="col-sm-10">
                    <input type="hidden" name="oldpassword" value='<?php echo $row['password']?>'>
                    <input type="password" name="newpassword" class="form-control"  autocomplete="new-password" />
            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('EMAIL')?></label>
                <div class="col-sm-10">
                    <input type="text" name="email" value='<?php echo $row['Email']?>' class="form-control"/>
            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('FULLNAME')?></label>
                <div class="col-sm-10">
                    <input type="text" name="fullname" value='<?php echo $row['Fullname']?>' class="form-control"/>
            </div>
                    </div>
                    <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="save"  class="btn btn-outline-primary">
            </div>
                    </div>
                 </form>
                     </div>

        
    <?php
    }else{
        echo 'error';
    }
   
    }elseif($do =='Update'){
        echo'<h1 class="text-center">Update members</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $id = $_POST['userid'];
            $username = $_POST['Username'];
            $email=$_POST['email'];
            $fullname=$_POST['fullname'];
            $pass=empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
            //validate the form;
            $formErrors=array();
            if(strlen($username) < 4){
                $formErrors[] = '<div class="alert alert-danger">you cant put the username less than 4 </div>';
            }
            if(strlen($username) > 10){
                $formErrors[] = '<div class="alert alert-danger">you cant put the username bigger than 10 </div>';
            }
            if(empty($username)){
                $formErrors[] = '<div class="alert alert-danger">you must put the username </div>';
            }
            if(empty($email)){
                $formErrors[] = '<div class="alert alert-danger">you must put the email address </div>';
            }
            if(empty($fullname)){
                $formErrors[] = '<div class="alert alert-danger">you must put your fullname </div>';
            }
            if(empty($pass)){
                $formErrors[] = '<div class="alert alert-danger">you must put your password </div>';
            }
            foreach($formErrors as $error){
                echo $error . '<br/>';
            }
            if(empty($formErrors)){
                $stmt2=$con->prepare("SELECT *  FROM  users  WHERE username = ?  AND  userID != ? ");
                $stmt2->execute(array($username, $id));
                $count=$stmt2->rowcount();
                if($count == 1){
                    $errormassages = 'Sorry this username already exist.';
                    up($errormassages, 2);
                }else{
                    $stmt=$con->prepare("UPDATE users SET username = ?, Email = ?, Fullname = ?, password = ? WHERE userID = ?");
                                $stmt->execute(array($username, $email, $fullname, $pass, $id));
                                if($stmt->rowcount() > 0){
                                    $themassge=  'Your information has been updated!';
                                    up($themassge, 2);
                                }
                }
          
                }

        }else{

             $errormassages = 'Sorry, you cannot access this page.';
             up($errormassages, 2);
        }
        echo "</div>";

        
    }elseif ($do == 'Insert' ) {
            
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo'<h1 class="text-center">Update members</h1>';                          
        echo "<div class='container'>";
            $username = $_POST['Username'];
            $email=$_POST['email'];
            $fullname=$_POST['fullname'];
            $hashpass = sha1($_POST['password']);
            //validate the form;
            $formErrors=array();
            if(strlen($username) < 4){
                $formErrors[] = '<div class="alert alert-danger">you cant put the username less than 4 </div>';
            }
            if(strlen($username) > 10){
                $formErrors[] = '<div class="alert alert-danger">you cant put the username bigger than 10 </div>';
            }
            if(empty($username)){
                $formErrors[] = '<div class="alert alert-danger">you must put the username </div>';
            }
            if(empty($hashpass)){
                $formErrors[] = '<div class="alert alert-danger">you must put the password  </div>';
            }
            if(empty($fullname)){
                $formErrors[] = '<div class="alert alert-danger">you must put your fullname </div>';
            }
            if(empty($email)){
                $formErrors[] = '<div class="alert alert-danger">you must put your email address </div>';
            }
            foreach($formErrors as $error){
                echo $error . '<br/>';
            }
            if(empty($formErrors)){
            $check=checkItem("username", "users", $username);
                if($check == 1){
                   $errormassages ='sorry username is exist';
                   up( $errormassages, 2);

                }else{
                    $stmt=$con->prepare("INSERT INTO users(username, password, Email, Fullname,	regStatus, Date)VALUES(:zusername, :zpass, :zemail, :zfullname, 1, now())");
                    $stmt->execute(array(
                        'zusername' => $username ,
                        'zpass' =>   $hashpass ,
                        'zemail' => $email , 
                        'zfullname' => $fullname ,

                    ));
                    if($stmt->rowcount() > 0){
                        $themassge=  'Add your information is done!';
                        up($themassge, 2); 
            }
            }
                }

        }else{
            $errormassages = 'sorry you cant browes this page';
            up($errormassages, 2);

        }
        echo "</div>";

    }elseif($do =='Delete'){
        echo'<h1 class="text-center">Delete members</h1>';
        echo "<div class='container'>";
        $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;

  
        $count= checkItem('userID', 'users', $user);
      if($count > 0){
        $stmt=$con->prepare('DELETE FROM users WHERE userID = :zuser');
        $stmt->execute(array(
            ':zuser' => $user
        ));
        $themassge= 'Delete your information is done!';
        up($themassge, 4); 

    }
        }elseif($do == 'pending'){
            $stmt = $con->prepare("SELECT * FROM users where GroupID != 1 AND regStatus= 0 ");
            $stmt->execute();
            $rows= $stmt->fetchAll();
            ?>
    <h1 class="text-center">Add new members</h1>
    <div class="container">
    <div class="table-responsive">
  <table class="main-table text-center table table-bordered">
    <tr class="table-dark">
        <td>#ID</td>
        <td>username</td>
        <td>Email</td>
        <td>Fullname</td>
        <td>registerd Date</td>
        <td>control</td>
    </tr>
    <?php
    foreach($rows as $row){
    echo'<tr>';
            echo'<td>' . $row['userID'] .'</td>'; 
            echo'<td>' . $row['username'] .'</td>'; 
            echo'<td>' . $row['Email'] .'</td>'; 
            echo'<td>' . $row['Fullname'] .'</td>'; 
            echo'<td>' . $row['Date'] .'</td>'; 
            echo"<td>
            <a href='members.php?do=edit&userID=". $row['userID'] ."' class='btn btn-success'>Edit</a>
            <a href='members.php?do=Delete&userID=". $row['userID'] ."' class='btn btn-danger confirm'>Delete</a>";
            if($row['regStatus'] == 0){
             echo "<a href='members.php?do=Delete&userID=". $row['userID'] ."' class='btn btn-info'>Active</a>";
            }

           echo "</td>"; 

    echo'</tr>';
    }


        }elseif($do =='active'){
            echo'<h1 class="text-center">Activate members</h1>';
            echo "<div class='container'>";
            $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;
      
            $count= checkItem('userID', 'users', $user);
          if($count > 0){
            $stmt=$con->prepare('UPDATE users SET regStatus = 1 WHERE userID = ?');
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