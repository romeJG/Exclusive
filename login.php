<?php
ob_start();
session_start();
$pageTitle='login';
if(isset($_SESSION['user'])){
  header('Location: index.php');
}
include 'init.php';
if($_SERVER['REQUEST_METHOD']=='POST'){ 
  $username = $_POST['username'];
  $password = sha1($_POST['password']);
//echo $username .' '. $hashpassword;
$stmt=$con->prepare('SELECT 
 userID, username, password FROM users WHERE username = ? AND password = ?');
$stmt -> execute(array($username, $password));
$row=$stmt->fetch();
$count= $stmt->rowcount();
if($count>0){
 $_SESSION['user']= $username;
 $_SESSION['userID']= $row['userID'];
 header('Location: index.php');

}
}else{
  // echo "error";
}
?>
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">EXCLUSIVE</h1>
        <p class="col-lg-10 fs-4">Welcome this is exclusive.</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
     
      <form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">login</button>
          <hr class="my-4">
          <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
        </form>
      </div>
    </div>
  </div>
