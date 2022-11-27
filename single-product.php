<?php 
    session_start();
    require_once('./inc/config.php');    
    require_once('./inc/helpers.php');  
    
    if(isset($_GET['product']) && !empty($_GET['product']) && is_numeric($_GET['product']))
    {
        $sql = "SELECT p.*,pdi.img from products p
            INNER JOIN product_images pdi ON pdi.product_id = p.product_id WHERE pdi.is_featured =:featured AND p.id =:productID";
        $handle = $db->prepare($sql);
        $params = [
                ':featured'=>1,
                ':productID' =>$_GET['product'],
            ];
        $handle->execute($params);
        if($handle->rowCount() == 1 )
        {
            $getProductData = $handle->fetch(PDO::FETCH_ASSOC);
            $imgUrl = PRODUCT_IMG_URL."/".$getProductData ['img'];
        }
        else
        {
            $error = '404! No record found';
        }
        
    }
    else
    {
        $error = '404! No record found';
    }

    if(isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == 'add to cart')
    {
        $productID = intval($_POST['product_id']);
        $productQty = intval($_POST['product_qty']);
        
        $sql = "SELECT p.*,pdi.img from products p
            INNER JOIN product_images pdi ON pdi.product_id = p.product_id WHERE pdi.is_featured =:featured AND p.id =:productID";

        $prepare = $db->prepare($sql);
        
        $params = [
                ':featured'=>1,
                ':productID' =>$productID,
            ];
        
        $prepare->execute($params);
        $fetchProduct = $prepare->fetch(PDO::FETCH_ASSOC);

        $calculateTotalPrice = number_format($productQty * $fetchProduct['price'],2);
        
        $cartArray = [
            'product_id' =>$productID,
            'qty' => $productQty,
            'product_name' =>$fetchProduct['product_name'],
            'product_price' => $fetchProduct['price'],
            'total_price' => $calculateTotalPrice,
            'product_img' =>$fetchProduct['img']
        ];
        
        if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
        {
            $productIDs = [];
            foreach($_SESSION['cart_items'] as $cartKey => $cartItem)
            {
                $productIDs[] = $cartItem['product_id'];
                if($cartItem['product_id'] == $productID)
                {
                    $_SESSION['cart_items'][$cartKey]['qty'] = $productQty;
                    $_SESSION['cart_items'][$cartKey]['total_price'] = $calculateTotalPrice;
                    break;
                }
            }

            if(!in_array($productID,$productIDs))
            {
                $_SESSION['cart_items'][]= $cartArray;
            }

            $successMsg = true;
            
        }
        else
        {
            $_SESSION['cart_items'][]= $cartArray;
            $successMsg = true;
        }

    }


	$pageTitle = 'Cool T-Shirt Shop Single Product Page';
	$metaDesc = 'Demo PHP shopping cart get products from database';
	
	
include('layout/header.php');

?>
<style>
      .box {
        width: 30%;
        height: 100%;
        border: 5px;
      }
      img {
        width: 100%;
        height: 100%;
      }
    </style>
<div style="margin: px;">
    <?php if(isset($getProductData) && is_array($getProductData)){?>
        <?php if(isset($successMsg) && $successMsg == true){?>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <img src="<?php echo $imgUrl ?>" class="rounded img-thumbnail mr-2" style="width:40px;"><?php echo $getProductData['product_name']?> is added to cart. <a href="cart.php" class="alert-link">View Cart</a>
                    </div>
                </div>
            </div>
         <?php }?>

        <div class="row mt-3">
            <div class="col-md-5 box">
                <img src="<?php echo $imgUrl;?>">
            </div>
            <div class="col-md-7">
                <h1><?php echo $getProductData['product_name']?></h1>
                <p><?php echo $getProductData['short_description']?></p>
                <h4>₱<?php echo $getProductData['price']?></h4>
                
                <form class="form-inline" method="POST">
                    <div class="form-group mb-2">
                        <input type="number" name="product_qty" id="productQty" class="form-control" placeholder="Quantity" min="1" max="1000" value="1">
                        <input type="hidden" name="product_id" value="<?php echo $getProductData['id']?>">
                    </div>
                    <div class="form-group mb-2 ml-2">
                        <button type="submit" class="btn btn-primary" name="add_to_cart" value="add to cart">Add to Cart</button>
                    </div>
                </form>
                
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <?php echo $getProductData['full_description']?>
            </div>
        </div>

    <?php
    }
    ?>
</div>

    

<?php include('layout/footer.php');?>