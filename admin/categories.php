<?php
session_start();
$pageTitle='members';
if(isset($_SESSION['username'])){
   include 'init.php';
   if(isset($_GET['do'])){
    $do= $_GET['do'];
    }else{
        $do='manage';
    }

    if($do =='manage'){
        $sort='DESC';
        $sort_Array=array('ASC','DESC');
        if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_Array)){
            $sort = $_GET['sort'];
        }
        $stmt = $con->prepare("SELECT * FROM categories ORDER BY ordering $sort");
        $stmt->execute();
        $rows= $stmt->fetchAll();
        ?>
    
        <h1 class="text-center">
            Add new categories
            <div class='ordering pull-right'>
                <a href='?sort=ASC'>ASC</a>
                <a href='?sort=DESC'>DESC</a>
        </h1>
        <div class="container">
        <div class="table-responsive">
      <table class="main-table text-center table table-bordered">
        <tr class="table-dark">
            <td>#ID</td>
            <td>name</td>
            <td>description</td>
            <td>ordering</td>
            <td>visibilty</td>
            <td>allow_comment</td>
            <td>allow_ads</td>
            <td>control</td>

        </tr>
        <?php
        foreach($rows as $row){
        echo'<tr>';
                echo'<td>' . $row['id']            .'</td>'; 
                echo'<td>' . $row['name']          .'</td>'; 
                echo'<td>' . $row['description']   .'</td>'; 
                echo'<td>' . $row['ordering']   .'</td>'; 
                echo'<td>' . $row['visibilty']     .'</td>'; 
                echo'<td>' . $row['allow_comment'] .'</td>'; 
                echo'<td>' . $row['allow_ads'] .'</td>'; 
                echo "<td>
                <a href='categories.php?do=edit&userID=". $row['id'] ."' class='btn btn-success'>Edit</a>
                <a href='categories.php?do=Delete&userID=". $row['id'] ."' class='btn btn-danger confirm'>Delete</a>";
                // if($row['regStatus'] == 0){
                //  echo "<a href='members.php?do=active&userID=". $row['userID'] ."' class='btn btn-info'>Active</a>";
                // }
    
               echo "</td>"; 
        echo'</tr>';
    }


    ?>

    
  </table>
</div>
     <a class="btn btn-primary" href="categories.php?do=Add"><i class="fas fa-plus"></i> Add new categorie</a>
    

  <?php  }elseif($do == 'Add'){?>
        <h1 class="text-center">Add new categories</h1>
        <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('name')?></label>
                <div class="col-sm-10">
                    <input type="text" name="name"  class="form-control" placeholder=" name the categorie" /> 
            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('description')?></label>
                <div class="col-sm-10">
                    <input type="text" name="description" class="form-control"  autocomplete="new-password" placeholder="Describe the categorie" />

            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('ordering')?></label>
                <div class="col-sm-10">
                    <input type="text" name="ordering"  class="form-control" placeholder="order the categorie"/>
            </div>
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('visibilty')?></label>
                <div class="col-sm-10">
        
                    <input id="vis-yes" type="radio" name="visibilty"  value="0" checked />
                    <lable for="vis-yes">Yes</lable>

            
            
                    <input id="vis-no" type="radio" name="visibilty"  value="1" />
                    <lable for="vis-no">No</lable>

            
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('allow-comment')?></label>
                <div class="col-sm-10">
                
                    <input id="vis-yes" type="radio" name="allow_comment"  value="0" checked />
                    <lable for="vis-yes">Yes</lable>

            
            
                    <input id="vis-no" type="radio" name="allow_comment"  value="1" />
                    <lable for="vis-no">No</lable>

            
                    </div>
                    <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('allow-ads')?></label>
                <div class="col-sm-10">
               
                    <input id="vis-yes" type="radio" name="allow_ads"  value="0" checked />
                    <lable for="vis-yes">Yes</lable>

            
            
                    <input id="vis-no" type="radio" name="allow_ads"  value="1" />
                    <lable for="vis-no">No</lable>

            
                    </div>
    </div>
                    <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Add categories"  class="btn btn-outline-primary">
            </div>
                    </div>
                 </form>
                     </div>
<?php
    }elseif ($do == 'Insert' ) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo'<h1 class="text-center">Update categories</h1>';                          
            echo "<div class='container'>";
                $name = $_POST['name'];
                $description = $_POST['description'];
                $ordering=$_POST['ordering'];
                $visibilty=$_POST['visibilty'];
                $allowcomment=$_POST['allow_comment'];
                $allowads=$_POST['allow_ads'];

                $formErrors=array();
                if(empty($name)){
                    $formErrors[] = '<div class="alert alert-danger">you must put the username </div>';
                }
                if(empty($description)){
                    $formErrors[] = '<div class="alert alert-danger">you must put the description of categories  </div>';
                }
                if(empty($ordering)){
                    $formErrors[] = '<div class="alert alert-danger">you must put number of categorie </div>';
                }
                foreach($formErrors as $error){
                    echo $error . '<br/>';
                }

                if(empty($formErrors)){
                $check=checkItem("name", "categories", $name);
                    if($check == 1){
                       $errormassages ='sorry username is exist';
                       up( $errormassages, 2);
                    }else{
                        $stmt=$con->prepare("INSERT INTO categories(name, description, ordering, visibilty, allow_comment, allow_ads) VALUES(:zname, :zdescription, :zordering, :zvisibilty, :zallow_comment, :zallow_ads)");
                        $stmt->execute(array(
                            'zname' => $name,
                            'zdescription' => $description,
                            'zordering' => $ordering , 
                            'zvisibilty' =>  $visibilty ,
                            'zallow_comment'=> $allowcomment ,
                            'zallow_ads'=>$allowads ,
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
            }
            echo "</div>";

  
    
        }elseif($do == 'edit'){

            $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;

      
      
            $stmt=$con->prepare('SELECT * FROM categories WHERE id = ?  LIMIT 1');
            $stmt -> execute(array($user));
            $row=$stmt->fetch();
            $count= $stmt->rowcount();
          if($count > 0){?> 
              <h1 class="text-center">Edit categorie</h1>
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
                  <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo lang('ordering')?></label>
                      <div class="col-sm-10">
                          <input type="text" name="ordering" value='<?php echo $row['ordering']?>' class="form-control"/>
                  </div>
                          </div>
                          <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo lang('visibilty')?></label>
                      <div class="col-sm-10">
                          <input type="text" name="visibilty" value='<?php echo $row['visibilty']?>' class="form-control"/>
                  </div>
                          </div>
                          <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo lang('allow-comment')?></label>
                      <div class="col-sm-10">
                          <input type="text" name="allow_comment" value='<?php echo $row['allow_comment']?>' class="form-control"/>
                  </div>
                          </div>
                          <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo lang('allow-ads')?></label>
                      <div class="col-sm-10">
                          <input type="text" name="allow_ads" value='<?php echo $row['allow_ads']?>' class="form-control"/>
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
        }elseif($do == 'Update'){
            echo'<h1 class="text-center">Update categories</h1>';
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $ordering=$_POST['ordering'];
            $visibilty=$_POST['visibilty'];
            $allowcomment=$_POST['allow_comment'];
            $allowads=$_POST['allow_ads'];

            $formErrors=array();
            if(empty($name)){
                $formErrors[] = '<div class="alert alert-danger">you must put the name of the categories </div>';
            }
            foreach($formErrors as $error){
                echo $error . '<br/>';
            }

            if(empty($formErrors)){
            $stmt=$con->prepare("UPDATE categories SET name = ?, description = ?, ordering = ?, visibilty = ?, allow_comment =?, allow_ads =? WHERE id = ?");
            $stmt->execute(array($name, $description, $ordering, $visibilty, $allowcomment, $allowads, $id));
            if($stmt->rowcount() > 0){
                $themassge=  'update your information is done!';
                up($themassge, 2);
            }
                }

        }else{

             $errormassages = 'sorry you cant browes this page';
             up($errormassages, 2);
        }
        echo "</div>";
        }elseif($do =='Delete'){
            echo'<h1 class="text-center">Delete members</h1>';
            echo "<div class='container'>";
            $user=isset($_GET['userID']) && is_numeric($_GET['userID'])?  intval($_GET['userID']) : 0;
    
      
            $count= checkItem('id', 'categories', $user);
          if($count > 0){
            $stmt=$con->prepare('DELETE FROM categories WHERE id = :zuser');
            $stmt->execute(array(
                ':zuser' => $user
            ));
            $themassge= 'Delete your information is done!';
            up($themassge, 4); 
    
        }
        }
        
    include  $tpl . 'footer.php';
}else{
    header('Location:index.php');
    
    exit();

}
?>