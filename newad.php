<?php
ob_start();
session_start();
require_once('./inc/config.php');    
$pageTitle='items';
if(isset($_SESSION['user'])){
   include 'init.php';//thats good
   if(isset($_GET['do'])){
    $do= $_GET['do'];
    }else{
        $do='Add';
    }

    if($do =='Add'){?>

        <h1 class="text-center">Add new items</h1>
    <div class="container" style="margin:20px;">
        <form class="form-horizontal" action="?do=Insert" method="POST" autocomplete="off" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name of Product</label>
                <div class="col-sm-10">
                    <input type="text" name="name"  class="form-control" placeholder="Name the item" /> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Short Description</label>
                <div class="col-sm-10">
                    <input maxlength="100" cols="50" type="text" name="short_desc"  class="form-control" placeholder="Short description of item" /> 
                </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Full Description</label>
                <div class="col-sm-10">
                    <input maxlength="2000" type="text" name="long_desc"  class="form-control" placeholder="Long description of item"/> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" name="price"  class="form-control" placeholder=" Add price " /> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-3">
                    <input type="file" name="img"  class="form-control btn btn-outline-primary" name="Choose file" /> 
                </div>
            </div>

            <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Add items"  class="btn btn-outline-primary">
            </div>
            </div>
        </form>
        </div>
    </div>
<?php
    }elseif($do == 'Insert'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo'<h1 class="text-center">Update items</h1>';                          
            echo "<div class='container'>";
                $name = $_POST['name'];
                $slug = str_replace(' ', '', strtolower($name));
                $shortDesc = $_POST['short_desc'];
                $longDesc = $_POST['long_desc'];
                $price = floatval($_POST['price']);
                $isFeat = 1;
                $isActive = 1;
                //date in yyyy-dd-mm hh:mm:ss timezone: gmt+8
                $dateNow = gmdate("Y-d-m H:i:s", time() + 3600*(8+date("I")));
                $productId = rand(100, 1000);
                

                $imgPath = PRODUCT_IMG_URL;
                $img = $_FILES['img'];
                $filename = $_FILES['img']['name'];
                $fileTmpName = $_FILES['img']['tmp_name'];
                $fileType = $_FILES['img']['type'];
                $fileSize = $_FILES['img']['size'];
                $fileError = $_FILES['img']['error'];
                $fileExt = explode('.',$filename);
                $fileActualExt = strtolower(end($fileExt));

                $formErrors=array();

                if(empty($name)){
                    $formErrors[] = '<div class="alert alert-danger">you must put the name of item </div>';
                }
                if(empty($shortDesc)){
                    $formErrors[] = '<div class="alert alert-danger">you must put short description of item  </div>';
                }
                if(empty($longDesc)){
                    $formErrors[] = '<div class="alert alert-danger">you must put long description of item  </div>';
                }
                if(empty($price)){
                    $formErrors[] = '<div class="alert alert-danger">you must put price of item</div>';
                }
                if(empty($img)){
                    $formErrors[] = '<div class="alert alert-danger">you must upload an image</div>';
                }
                
                $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($fileActualExt, $allowed)){
                    if($fileError === 0){
                        if($fileSize){
                            $fileNameNew = uniqid('', true).".".$fileActualExt;
                            $fileDestination = $imgPath.$fileNameNew;
                        }else{
                            $formErrors[] = '<div class="alert alert-danger">your file is too big!</div>';
                        }
                    }else{
                        $formErrors[] = '<div class="alert alert-danger">there was an error uploading your file</div>';
                    }
                }else{
                    $formErrors[] = '<div class="alert alert-danger">you cannot upload images of this type</div>';
                }

                foreach($formErrors as $error){
                    echo $error . '<br/>';
                }

                if(empty($formErrors)){
                        $stmt=$con->prepare("INSERT INTO products(product_name, product_slug, short_description, full_description, price, is_featured, is_active, created_at, updated_at, product_id)VALUES(:zname, :zslug, :zshortDesc, :zlongDesc, :zprice, :zisFeat, :zisActive, :zcreatedAt, :zupdatedAt, :zproductId)");
                        $stmt->execute(array(
                            'zname' => $name,
                            'zslug' => $slug,             
                            'zshortDesc' => $shortDesc,
                            'zlongDesc' => $longDesc,
                            'zprice' => $price,
                            'zisFeat' => $isFeat,
                            'zisActive' => $isActive,
                            'zcreatedAt' => $dateNow,
                            'zupdatedAt' => $dateNow,
                            'zproductId' => $productId
                        ));
                        $st=$con->prepare("INSERT INTO product_images(product_id, img, display_order, is_featured)VALUES(:zprodId, :zimg, :zdisplay_order, :zisFeatured)");
                        $st->execute(array(
                            'zprodId' => $productId,
                            'zimg' => $fileNameNew,
                            'zdisplay_order' => 1,
                            'zisFeatured' => 1
                        ));
                        // up_image($fileloc, $imgPath);
                        move_uploaded_file($fileTmpName, $fileDestination);


                        if(($stmt->rowcount() > 0) && ($st->rowCount() > 0)){
                            $themassge =  'Add your information is done!';
                            up($themassge, 2); 
                        }
                
                }
    
            }else{
                $errormassages = 'sorry you cant browse this page';
                up($errormassages, 2);
    
            }
            echo "</div>";
    }
    include  $tpl . 'footer.php';
}else{
    header('Location:index.php');
    
    exit();

}