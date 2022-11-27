<?php 
    session_start();

     if(!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order']))
     {
         header('location:index.php');
         exit();
     }

    require_once('./inc/config.php');    
    require_once('./inc/helpers.php');  
    include 'init.php';

    
	$pageTitle = 'Demo Thank You';
	$metaDesc = 'Demo PHP shopping cart thank you page';
	
?>
<div class="row">
    <div class="col-md-12">
        <h1>Thank you!</h1>
        <p>
            Your order has been placed.
            <?php unset($_SESSION['confirm_order']);?>
        </p>
    </div>
</div>