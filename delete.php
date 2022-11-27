<?php
include("admin/connect.php");

$rollno = (int)$_GET['rn'];

$query = "DELETE FROM products WHERE product_id = '$rollno'";
$data = mysqli_query($consqli, $query);

if ($data){
    echo '<div class="alert alert-danger">you must upload an image</div>';
    
}

header("Location: profile.php");
?>