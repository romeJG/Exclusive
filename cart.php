<?php 
    session_start();
    require_once('./inc/config.php');    
    require_once('./inc/helpers.php');  

    if(isset($_GET['action'],$_GET['item']) && $_GET['action'] == 'remove')
    {
        unset($_SESSION['cart_items'][$_GET['item']]);
        header('location:cart.php');
        exit();
    }
	
	

    include 'init.php';
    //pre($_SESSION);
?>

<div class="row" style="margin:3rem;" >
    <div class="col-md-12">
        <?php if(empty($_SESSION['cart_items'])){?>
        <table class="table">
            <tr>
                <td>
                    <center>
                        <a href="items.php">
                            <button style="padding:30px;" class="btn btn-danger btn-sm">Cart is Empty shop here!</button>
                        </a>
                    <center>
                </td>
            </tr>
        </table>
        <?php }?>
        <?php if(isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0){?>
        <table class="table">
           <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $totalCounter = 0;
                    $itemCounter = 0;
                    foreach($_SESSION['cart_items'] as $key => $item){

                     $imgUrl = PRODUCT_IMG_URL."/".$item['product_img'];   
                    
                    $total = $item['product_price'] * $item['qty'];
                    $totalCounter+= $total;
                    $itemCounter+=$item['qty'];
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo $imgUrl; ?>" class="rounded img-thumbnail mr-2" style="width:60px;"><?php echo $item['product_name'];?>
                            
                            <a href="cart.php?action=remove&item=<?php echo $key?>" class="text-danger">
                                <i class="bi bi-trash-fill"></i>
                            </a>

                        </td>
                        <td>
                            ₱<?php echo $item['product_price'];?>
                        </td>
                        <td>
                            <input type="number" name="" class="cart-qty-single" data-item-id="<?php echo $key?>" value="<?php echo $item['qty'];?>" min="1" max="1000" >
                        </td>
                        <td>
                            <?php echo $total;?>
                        </td>
                    </tr>
                <?php }?>
                <tr class="border-top border-bottom">
                    <td><button class="btn btn-danger btn-sm" id="emptyCart">Clear Cart</button></td>
                    <td>
                        <strong>
                            <?php 
                                echo ($itemCounter==1)?$itemCounter.' item':$itemCounter.' items'; ?>
                        </strong>
                    </td>
                    <td><strong>₱<?php echo $totalCounter;?></strong></td>
                </tr> 
                </tr>
            </tbody> 
        </table>
        <div class="row">
            <div class="col-md-11">
                <?php
                if(isset($_SESSION['user'])){
                ?>
				<a href="checkout.php">
					<button class="btn btn-primary btn-lg float-right">Checkout</button>
				</a>
                <?php
                }else{?>
                <center>
                    <a href="login.php">
                        <button style="padding:30px;" class="btn btn-danger btn-sm">Please Login or signup to checkout</button>
                    </a>
                </center>
                <?php
                }
                ?>
                

            </div>
        </div>
        
        <?php }?>
    </div>
</div>
<?php
include ("layout/footer.php");
?>