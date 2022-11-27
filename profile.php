<?php
ob_start();
session_start();
$pageTitle='profile page';
include 'init.php';
if(isset($_SESSION['user'])){
    $geta=$con->prepare("SELECT * FROM users WHERE username = ?");
    $geta->execute(array($_SESSION['user']));
    $row=$geta->fetch();
?>
<div class="container ">
    <div class="row align-items-center g-lg-5 co">
      <div class="col-md-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">Profile settings</h1>
      </div>
<div class="card">
  <div class="card-header">
    Profile Information
  </div>
  <div class="card-body">
    <h5 class="card-title">
    <?php 
    echo'<i class="fas fa-sign-in-alt"></i>';
echo 'login name' . " ".':' . $row['username'];echo'</br>';
echo '<i class="fas fa-envelope-square"></i>';
echo 'Email' . " ".':' . $row['Email'];echo'</br>';
echo'<i class="fas fa-file-signature"></i>';
echo 'Fullname' . " ".':' . $row['Fullname'];echo'</br>';
echo'<i class="fas fa-calendar-week"></i>';
echo 'RegDate' . " ".':' . $row['Date'];echo'</br>';
if ($row['member_id'] = 1){
echo 'is an ADMIN';echo'</br>';}
?>
</h5>
  </div>
</div>
<?php
if ($row['GroupID'] == 1){
?>
<div class="card" style="margin:5rem">
  <div class="card-header">
 Items
  </div>
  <div class="card-body">
    <h5 class="card-title">
    <?php


echo '<div class="row">';
foreach(getitems('is_active ',1) as $item){
  echo '<div class="col-md-4" style="margin-top:10px;  ">';
  echo  '<div class="card" style="width: 18rem; padding:30px;">'; 
  echo '<span class="prive-tag">'.$item['price'].'</span>';
  echo '<div class="card-body">';
  echo  '<h4 class="card-title">'.$item['product_name'].'</h4>';
  echo ' <a href="delete.php?rn='.$item['product_id'].'" class="text-danger"><i class="bi bi-trash-fill"></i> Remove Item</a>';
  echo '</div>';
  echo '</div>';
  echo '</div>';

}

echo '</div>';

?>


    </h5>
    <p class="card-text"></p>
    <a href="newad.php?do=Add" class="btn btn-primary">creat new item</a>
  </div>
</div>
<?php
}
?>


</div>
<?php
}else{
    header('Location:login.php');
    exit();
}
include  $tpl . 'footer.php';?>