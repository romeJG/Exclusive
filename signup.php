 <?php
      ob_start();
     session_start();
      $pageTitle='signup';
    
        include 'init.php';
          
        if(isset($_GET['do'])){
         $do= $_GET['do'];
         
         }else{
             $do='Add';
     
         }if($do == 'Add'){//Add page;?>
             <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">EXCLUSIVE</h1>
        <p class="col-lg-10 fs-4">This is exclusive.</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
     
      <form class="form-horizontal" action="?do=Insert" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="fullname" class="form-control" id="floatingPassword" placeholder="Full Name">
            <label for="floatingPassword">Fullname</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="floatingPassword" placeholder="name@example.com">
            <label for="floatingPassword">Email</label>
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
     
     
        <?php
         }elseif ($do == 'Insert' ) {
                 
             if($_SERVER['REQUEST_METHOD'] == 'POST'){
             echo'<h1 class="text-center">Insert member</h1>';                          
             echo "<div class='container'>";
                 $username = $_POST['username'];
                 $shapass = sha1($_POST['password']);
                 $email=$_POST['email'];
                 $fulname=$_POST['fullname'];
                 //validate the form;
                 $formErrors=array();
                 if(strlen($username) < 4){
                     $formErrors[] = '<div class="alert alert-danger">you cant put the username less than 4 </div>';
                 }
                 if(strlen($username) > 20){
                     $formErrors[] = '<div class="alert alert-danger">you cant put the username bigger than 20 </div>';
                 }
                 if(empty($username)){
                     $formErrors[] = '<div class="alert alert-danger">you must put the username </div>';
                 }
                 if(empty($pass) < 4){
                     $formErrors[] = '<div class="alert alert-danger">you cant put the password less than 4  </div>';
                 }
                 if(empty($pass) > 7){
                  $formErrors[] = '<div class="alert alert-danger">you cant put the password bigger than 7 </div>';
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
                         $stmt=$con->prepare("INSERT INTO users(username, password, Email, Fullname, regStatus)VALUES(:zusername, :zpass, :zemail, :zfullname, 0)");
                         $stmt->execute(array(
                             'zusername' => $username ,
                             'zpass' =>  $shapass ,
                             'zemail' => $email , 
                            'zfullname'=> $fulname,
                         ));
                         if($stmt->rowcount() > 0){
                             $themassge=  'Congratulations! You may now login.';
                             up($themassge, 2); 
                 }
                 }
                     }
     
             }else{
                 $errormassages = 'Sorry looks like we have a problem here.Try again.';
                 up($errormassages, 2);
     
             }
             echo "</div>";
            }

     
    
    