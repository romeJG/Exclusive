<?php
$do ='';
if(isset($_GET['do'])){
$do= $_GET['do'];

}else{
    $do='manage';
}
// if main page
if($do == 'manage'){
    echo 'welcome you are in main page';
    echo '<a href="page.php?do=Add">Add new category +</a>';
}elseif($do == 'Add'){
    echo 'welcome you are in Add page';
}elseif($do=='insert'){
    echo 'Welcome you are in Insert page';
}else{
    echo 'error';
}


?>