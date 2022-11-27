<?php
$pageTitle='items';
session_start();
if(isset($_SESSION['username'])){
   include 'init.php';
   if(isset($_GET['do'])){
    $do= $_GET['do'];
    }else{
        $do='manage';
    }

    if($do =='manage'){
    $stmt = $con->prepare("SELECT items.*,categories.name AS categoriename,users.username FROM items  
    INNER JOIN categories ON categories.id = items.cat_id 
    INNER JOIN users ON users.userID = items.member_id");
    $stmt->execute();
    $rows= $stmt->fetchAll();
    ?>

    <h1 class="text-center">Add new items</h1>
    <div class="container">
    <div class="table-responsive">
  <table class="main-table text-center table table-bordered">
    <tr class="table-dark">
        <td>#ID</td>
        <td>name</td>
        <td>description</td>
        <td>price</td>
        <td>add_date</td>
        <td>country_made</td>
        <td>status</td>
        <td>rating</td>
        <td>categoriy</td>
        <td>member</td>
        <td>control</td>
    </tr>
    <?php
    foreach($rows as $row){
    echo'<tr>';
            echo'<td>' . $row['id'] .'</td>'; 
            echo'<td>' . $row['name'] .'</td>'; 
            echo'<td>' . $row['description'] .'</td>'; 
            echo'<td>' . $row['price'] .'</td>'; 
            echo'<td>' . $row['add_date'] .'</td>'; 
            echo'<td>' . $row['country_made'] .'</td>'; 
            echo'<td>' . $row['status'] .'</td>'; 
            echo'<td>' . $row['rating'] .'</td>'; 
            echo'<td>' . $row['categoriename'] .'</td>'; 
            echo'<td>' . $row['username'] .'</td>'; 
            echo"<td>
            <a href='items.php?do=edit&userID=". $row['id'] ."' class='btn btn-success'>Edit</a>
            <a href='items.php?do=Delete&userID=". $row['id'] ."' class='btn btn-danger confirm'>Delete </a>";
            if($row['approve'] == 0){
                echo "<a href='items.php?do=Approve&id=". $row['id'] ."' class='btn btn-info'>Approve </a>";
               }
           echo "</td>"; 
    echo'</tr>';
}
?>
</table>
</div>
 <a class="btn btn-primary" href="items.php?do=Add"><i class="fas fa-plus"></i> Add new items</a>
 <?php
    }elseif($do == 'Add'){?>
    <!-- start name -->
        <h1 class="text-center">Add new items</h1>
        <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('name')?></label>
                <div class="col-sm-10">
                    <input type="text" name="name"  class="form-control" placeholder=" name the item" /> 
            </div>
                    </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('description')?></label>
                <div class="col-sm-10">
                    <input type="text" name="description"  class="form-control" placeholder=" description of item" /> 
            </div>
                    </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('price')?></label>
                <div class="col-sm-10">
                    <input type="text" name="price"  class="form-control" placeholder=" Add price " /> 
            </div>
                    </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('country_made')?></label>
                <div class="col-sm-10">
                    <input type="text" name="country_made"  class="form-control" placeholder=" country of the items " /> 
            </div>
                    </div>
                    <!-- end country_made--> 
                        <!-- start status -->
                        <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('status')?></label>
                <div class="col-sm-10">
                    <select  name="status"class="form-select" aria-label="Disabled select example"  > 
                    <option value="0">--</option>
                    <option value="1">New</option>
                    <option value="2">Like New</option>
                    <option value="3">used</option>
    </select>
            </div>
                    </div>
                <!-- start status -->
                <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('rating')?></label>
                <div class="col-sm-10">
                    <select  name="rating" class="form-select" aria-label="Disabled select example" > 
                        <option value="1">*</option>
                        <option value="2">**</option>
                        <option value="3">***</option>
                        <option value="4">****</option>
                        <option value="5">*****</option>

    </select>
            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('MEMBERS')?></label>
                <div class="col-sm-10">
                    <select  name="MEMBERS" class="form-select" aria-label="Disabled select example" > 
                        <option value="0">--</option>
                        <?php 
                        $stmt=$con->prepare("SELECT * FROM users");
                        $stmt->execute();
                        $users = $stmt->fetchAll();
                        foreach($users as $user){
                            echo "<option value='".$user['userID'] . "'>". $user['username'] . "</option>";
                        }
                        ?>
    </select>
            </div>
                    </div>
                                        <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('CATEGORIES')?></label>
                <div class="col-sm-10">
                    <select  name="CATEGORIES" class="form-select" aria-label="Disabled select example" > 
                        <option value="0">--</option>
                        <?php 
                        $stmt=$con->prepare("SELECT * FROM categories");
                        $stmt->execute();
                        $users = $stmt->fetchAll();
                        foreach($users as $user){
                            echo "<option value='".$user['id'] . "'>". $user['name'] . "</option>";
                        }
                        ?>
    </select>
            </div>
                    </div>

                    <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Add items"  class="btn btn-outline-primary">
            </div>
                    </div>
                 </form>
                     </div>
<?php

    }elseif($do =='edit'){
        $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;
        // cheack the id is number and get the value id 
        $stmt=$con->prepare('SELECT * FROM items WHERE id = ? LIMIT 1');
        $stmt -> execute(array($user));
        $row=$stmt->fetch();
        $count= $stmt->rowcount();
      if($count > 0){?> 
          <h1 class="text-center">Edit item</h1>
          <div class="container">
          <form class="form-horizontal" action="?do=Update" method="POST">
              <input type="hidden" name="id" value="<?php echo $user ?>">
              <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo lang('name')?></label>
                  <div class="col-sm-10">
                      <input type="text" name="name" value='<?php echo $row['name']?>' class="form-control"/>
              </div>
                      </div>
                      <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo lang('description')?></label>
                  <div class="col-sm-10">
                      <input type="text" name="description" value='<?php echo $row['description']?>' class="form-control"/>
              </div>
                      </div>
                      <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo lang('price')?></label>
                  <div class="col-sm-10">
                      <input type="text" name="price" value='<?php echo $row['price']?>' class="form-control"/>
              </div>
                      </div>
                      <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo lang('country_made')?></label>
                  <div class="col-sm-10">
                      <input type="text" name="country_made" value='<?php echo $row['country_made']?>' class="form-control"/>
              </div>
                      </div>
                      <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo lang('status')?></label>
                  <div class="col-sm-10">
                      <input type="text" name="status" value='<?php echo $row['status']?>' class="form-control"/>
              </div>
                      </div>
                      <div class="form-group">
                  <label class="col-sm-2 control-label"><?php echo lang('rating')?></label>
                  <div class="col-sm-10">
                      <input type="text" name="rating" value='<?php echo $row['rating']?>' class="form-control"/>
              </div>
                      </div>
               
                      <div class="form-group form-group-lg">
                  <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" value="save"  class="btn btn-outline-primary">
              </div>
                      </div>
                   </form>
                       </div>
  
          
      <?php
      }else{
          echo 'error';
      }


    }elseif($do =='Update'){
        echo'<h1 class="text-center">Update items</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price=$_POST['price'];
            $country_made=$_POST['country_made'];
            $status=$_POST['status'];
            $rating=$_POST['rating'];
            //validate the form;
            $formErrors=array();
            if(empty($name)){
                $formErrors[] = '<div class="alert alert-danger">you must put the name of the items </div>';
            }
            if(empty($price)){
                $formErrors[] = '<div class="alert alert-danger">you must put the price of the items </div>';
            }
            if(empty($description)){
                $formErrors[] = '<div class="alert alert-danger">you must put the decripton of the items </div>';
            }
            if(empty($status)){
                $formErrors[] = '<div class="alert alert-danger">you must put the status of the items </div>';
            }
            if(empty($rating)){
                $formErrors[] = '<div class="alert alert-danger">you must put the rating of the items </div>';
            }
            if(empty($country_made)){
                $formErrors[] = '<div class="alert alert-danger">you must put the country_made of the items</div>';
            }
            foreach($formErrors as $error){
                echo $error . '<br/>';
            }
            // no error Update;
            if(empty($formErrors)){
            $stmt=$con->prepare("UPDATE items SET name = ?, description = ?, price = ?, country_made = ?, status =?, rating =? WHERE id = ?");
            $stmt->execute(array($name, $description, $price, $country_made, $status, $rating, $id));
            if($stmt->rowcount() > 0){
                $themassge=  'update your information is done!';
                up($themassge, 2);
            }

          
                }
            }
        


    }elseif ($do == 'Insert' ) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo'<h1 class="text-center">Update items</h1>';                          
            echo "<div class='container'>";
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $country_made = $_POST['country_made'];
                $status =$_POST['status'];
                $rating =$_POST['rating'];
                $MEMBERS = $_POST['MEMBERS'];
                $CATEGORIES = $_POST['CATEGORIES'];
                //validate the form;
                $formErrors=array();
                if(empty($name)){
                    $formErrors[] = '<div class="alert alert-danger">you must put the name of item </div>';
                }
                if(empty($description)){
                    $formErrors[] = '<div class="alert alert-danger">you must put description of item  </div>';
                }
                if(empty($price)){
                    $formErrors[] = '<div class="alert alert-danger">you must put price of item</div>';
                }
                if(empty($country_made)){
                    $formErrors[] = '<div class="alert alert-danger">you must put country_made of item </div>';
                }
                if(empty($status)){
                    $formErrors[] = '<div class="alert alert-danger">you must put status of item </div>';
                }
                if(empty($rating)){
                    $formErrors[] = '<div class="alert alert-danger">you must put rating of item </div>';
                }
                 if($MEMBERS == 0){
                    $formErrors[] = '<div class="alert alert-danger">you must put name of member </div>';
                }
                if($CATEGORIES == 0 ){
                    $formErrors[] = '<div class="alert alert-danger">you must put CATEGORIES of item </div>';
                }
                foreach($formErrors as $error){
                    echo $error . '<br/>';
                }
                // no error Update;
                if(empty($formErrors)){
                        $stmt=$con->prepare("INSERT INTO items(name, description, price, add_date, country_made, status, rating, cat_id, member_id )VALUES(:zname, :zdescription, :zprice, now(),:zcountry_made, :zstatus, :zrating, :zcat_id, :zmember_id)");
                        $stmt->execute(array(
                            'zname' => $name ,
                            'zdescription' => $description ,
                            'zprice' => $price , 
                            'zcountry_made' => $country_made ,
                            'zstatus' => $status ,
                            'zrating' => $rating ,
                            'zcat_id' => $CATEGORIES,
                            'zmember_id'=>$MEMBERS,
                        ));
                        if($stmt->rowcount() > 0){
                            $themassge=  'Add your information is done!';
                            up($themassge, 2); 
                }
                
                    }
    
            }else{
                $errormassages = 'sorry you cant browes this page';
                up($errormassages, 2);
    
            }
            echo "</div>";


      }  elseif($do =='Delete'){
        echo'<h1 class="text-center">Delete items</h1>';
        echo "<div class='container'>";
        $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;

  
        $count= checkItem('id', 'items', $user);
      if($count > 0){
        $stmt=$con->prepare('DELETE FROM items WHERE id= :zuser');
        $stmt->execute(array(
            ':zuser' => $user
        ));
        $themassge= 'Delete your information is done!';
        up($themassge, 4); 
    }
      }elseif($do =='Approve'){
        echo'<h1 class="text-center">Approve ads</h1>';
        echo "<div class='container'>";
        $user=isset($_GET['id']) && is_numeric($_GET['id'])?  intval($_GET['id']) : 0;

        // cheack the id is number and get the value id 
  
        $count= checkItem('id', 'items', $user);
      if($count > 0){
        $stmt=$con->prepare('UPDATE items SET approve = 1 WHERE id = ?');
        $stmt->execute(array($user));
        $themassge= 'Activate your information is done!';
        up($themassge, 4); 
    }
      }
    
    include  $tpl . 'footer.php';
  }else{
      header('Location:index.php');
      
      exit();
  
  }