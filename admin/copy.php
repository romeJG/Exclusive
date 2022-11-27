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


    }elseif($do == 'Add'){


    }elseif($do =='edit'){



    }elseif($do =='Update'){



    }elseif ($do == 'Insert' ) {



      }  elseif($do =='Delete'){
      
      }
    
    include  $tpl . 'footer.php';
  }else{
      header('Location:index.php');
      
      exit();
  
  }
?>
