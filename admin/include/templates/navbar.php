
<main>
<header class="p-3 bg-primary text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
       
          <li><a href="../login.php" class="fs-4 text-white">DEER</a></li>
          <li><a href="categories.php?do=manage" class="nav-link px-2 text-white"><?php echo lang('CATEGORIES')?>
          <span class="badge bg-light text-dark rounded-pill align-text-bottom"><?php $stmt2= $con->prepare("SELECT COUNT(id) FROM categories");
    $stmt2->execute();
    echo $stmt2->fetchColumn();
    ?>
        </a></li>
          <li><a href="items.php?do=manage" class="nav-link px-2 text-white"><?php echo lang('ITEMS')?>
          <span class="badge bg-light text-dark rounded-pill align-text-bottom"><?php $stmt2= $con->prepare("SELECT COUNT(id) FROM items");
    $stmt2->execute();
    echo $stmt2->fetchColumn();
    ?>
        </a></li>
        <li><a href="comment.php?do=manage" class="nav-link px-2 text-white"><?php echo lang('comment')?>
          <span class="badge bg-light text-dark rounded-pill align-text-bottom"><?php $stmt2= $con->prepare("SELECT COUNT(c_id ) FROM comment");
    $stmt2->execute();
    echo $stmt2->fetchColumn();
    ?>
          <li><a href="members.php?do=manage" class="nav-link px-2 text-white"><?php echo lang('MEMBERS')?>
          <span class="badge bg-light text-dark rounded-pill align-text-bottom"><?php $stmt2= $con->prepare("SELECT COUNT(userID) FROM users ");
    $stmt2->execute();
    echo $stmt2->fetchColumn();
    ?>
        </a></li>

          <li><a href="members.php?do=edit&userID=<?php echo $_SESSION['ID']?>" class="nav-link px-2 text-white"><?php echo lang('EDIT PROFILE')?></a></li>
        </ul>

    

        <div class="text-end">
        <a href="dashboard.php"  class="btn btn-outline-light me-2">dashboard</button>
          <a href="logout.php" class='btn btn-outline-light me-2'><?php echo lang('LOGOUT')?></a>
        </div>
      </div>
    </div>
  </header>




    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
