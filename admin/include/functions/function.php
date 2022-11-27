<?php

function getTitle() {

    global $pageTitle;

    if(isset($pageTitle)){

        echo $pageTitle;

    }else{
        echo'Default';
    }
}
    function up($errormsg, $seconds = 3){
        global $errormassages;
        global $themassge;
        $url= isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!== '' ?$_SERVER['HTTP_REFERER'] :'index.php';
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
//make check 
function checkItem($select, $from, $value){

    global $con;

    $stmt2 = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
    $stmt2->execute(array($value));
    $count=$stmt2->rowCount();
    return $count;


}
function cou($cou, $table){
    global $con;
    $stmt2= $con->prepare("SELECT COUNT($cou) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}

function getlist($select, $table , $order , $limit = 5){

    global $con;
    $getstmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getstmt->execute();
    $rows=$getstmt->fetchAll();
    return $rows;


}

?>