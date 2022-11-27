<?php
  ob_start();
  session_start();
$pageTitle='categories';
include 'init.php';
if(isset($_GET['pagename']) && isset($_GET['pageid']) && isset($_SESSION['user'])){
?>

<div class="container">
    <h3 class="text-center"><?php echo $_GET['pagename'] ?></h3>
    <div class="row">
<?php
foreach(getitems('cat_id ',$_GET['pageid']) as $item){
echo  '<div class="card" style="width: 18rem;">';
echo '<span class="prive-tag">'.$item['price'].'</span>';
echo '<img src="./layout/images/undraw_web_shopping_re_owap.png" class="card-img-top" alt="...">';
echo '<div class="card-body">';
echo  '<h3 class="card-title">'.$item['name'].'</h3>';
echo   '<p class="card-text">'.$item['description'].'</p>';
echo    '<a href="#" class="btn btn-primary">Go somewhere</a>';
echo  '</div>';
echo '</div>';
}
?>
</div>
</div>
<?php
}else{
    header('Loction:login.php');
}


include  $tpl . 'footer.php';