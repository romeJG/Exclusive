<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($pageTitle)?$pageTitle:'PHP Shopping Cart')?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
   <div class="container">
        <div class="row mt-2 mb-2">
            <div class="col-md-12 col-xs-12">
                <h1>
                    Cool T-Shirt Shop
                </h1>
            </div>
        </div>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0"">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <a href="cart.php" style="color:#ffffff">
                    <i class="bi bi-cart4" style="font-size:30px;"></i>
                    <?php 
                        echo (isset($_SESSION['cart_items']) && count($_SESSION['cart_items'])) > 0 ? count($_SESSION['cart_items']):'';
                    ?>
                </a>
            </div>
            
        </nav>