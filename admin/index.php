<?php
session_start();
$Nonavbar='';
$pageTitle='login';
if(isset($_SESSION['username'])){
  header('Location: dashboard.php');
}
include 'init.php';
include $tpl .'header.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
//echo $username .' '. $hashpassword;
$stmt=$con->prepare('SELECT 
userID, username, password FROM users WHERE username = ? AND password = ? AND GroupID = 1 LIMIT 1');
$stmt -> execute(array($username, $password));
$row=$stmt->fetch();
$count= $stmt->rowcount();
if($count>0){
   $_SESSION['username']= $username;
   $_SESSION['ID']= $row['userID'];
header('Location:dashboard.php');
  
}
}else{

}
?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">ADMIN PAGE</h1>
        <p class="col-lg-10 fs-4">Welcome exclusive.</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">username</label>
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
          <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
          <hr class="my-4">
          <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
        </form>
      </div>
    </div>
  </div>
<?php
include  $tpl . 'footer.php';
?>