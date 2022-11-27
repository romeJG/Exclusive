<?php 
    session_start();
    require_once('./inc/config.php');    
    require_once('./inc/helpers.php');  

    $sql = "SELECT p.*,pdi.img from products p
                    INNER JOIN product_images pdi ON pdi.product_id = p.product_id
                    WHERE pdi.is_featured = 1";
    $handle = $db->prepare($sql);
    $handle->execute();
    $getAllProducts = $handle->fetchAll(PDO::FETCH_ASSOC);

    // include('layout/header.php');
    include 'init.php';
?>
<style>
      .box {
        width: 30%;
        height: 200px;
        border: 5px dashed #f7a239;
      }
      img {
        width: 100%;
        height: 100%;
      }
    </style>
<div style="margin: 30px; ">
    <h1>
        Shopping
    </h1>
    <div class="row" style="margin-top: 30px; " >
        <?php
        foreach($getAllProducts as $product)
        {
            $imgUrl = PRODUCT_IMG_URL."/".$product['img'];
        ?>
            <div class="col-md-3  mt-2" style="height=1rem;">
                <div class="card">
                     <a href="single-product.php?product=<?php echo $product['id']?>">
                        <div sclass="box" >
                            <img class="card-img-top" src="<?php echo $imgUrl ?>" alt="<?php echo $product['product_name'] ?>">
                        </div>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="single-product.php?product=<?php echo $product['id'] ?>">
                                <?php echo $product['product_name']; ?>
                            </a>
                        </h5>
                        <strong>₱ <?php echo $product['price']?></strong>

                        <p class="card-t">
                            <?php echo substr($product['short_description'],0,50) ?>
                        </p>
                        <p class="card-text">
                            <a href="single-product.php?product=<?php echo $product['id']?>" class="btn btn-primary btn-sm">
                                View
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        <?php 
        }
        ?>
    </div>
</div>