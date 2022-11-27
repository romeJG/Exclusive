<?php
function getTitle() {

global $pageTitle;

if(isset($pageTitle)){

    echo $pageTitle;

}else{
    echo'Default';
}
}
function getcat(){
    global $con;
    $getcats = $con->prepare("SELECT * FROM categories ORDER BY id ASC");
    $getcats->execute();
    $cats=$getcats->fetchAll();
    return $cats;
}
function getitems($where ,$value){
    global $con;
    $getitem = $con->prepare("SELECT * FROM products WHERE $where=? ORDER BY id DESC");
    $getitem->execute(array($value));
    $items=$getitem->fetchAll();
    return $items;

}
function up($errormsg, $seconds = 3){
    global $errormassages;
    global $themassge;
    $url='login.php';
    if(isset($themassge)){
        echo "<div class='alert alert-success'>the website will change $themassge</div>";
        echo "<div class='alert alert-info'>after $seconds</div>";
        header("refresh:$seconds;url=$url");
    }
    if (isset($errormassages)){
        echo "<div class='alert alert-danger'>the website will change $errormassages</div>";
        echo "<div class='alert alert-info'>after $seconds seconds</div>";
        header("refresh:$seconds;url=$url");
}
}

 function checkstatus($user){
    global $con;
    $stmt=$con->prepare('SELECT 
 username, regStatus FROM users WHERE username = ? AND regStatus = 0');
$stmt -> execute(array($user));
$status= $stmt->rowcount();
return $status;
}

function checkItem($select, $from, $value){

    global $con;

    $stmt2 = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
    $stmt2->execute(array($value));
    $count=$stmt2->rowCount();
    return $count;


}




?>