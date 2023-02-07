<?php
include 'db_connection/connection.php';
session_start();
?>

<?php
   
  include 'nav_menu.php';
?>

<style>
  h1 {text-align: center;}
  p {text-align: center;}
</style>

    <?php

        if($_SESSION['usertype'] == 'painter')
        {
            
        }
        else
        {
    ?>
            <script>
                window.location.assign('homepage.php');
            </script>
    <?php
        }

    ?>

    <?php

        if(isset($_POST['Submit']))
        {
            
            $name = $_POST['name'];
            $type = $_POST['type'];
           
            $painter_id = $_SESSION['userId'];

            if(isset($_FILES['image']))
            {

                $image = $_FILES['image'];
                move_uploaded_file($image['tmp_name'],"images/$name.png");
            }

            $sqlquery = "INSERT INTO products (id, name, product_type, painter_id, image, purchase_status, bid_completed_status) VALUES (NULL, '$name', '$type', '$painter_id', 'images/$name.png', '0', '0')";
            $returnVal = $dbcon->exec($sqlquery);

            if($returnVal == 1)
            {
              echo 'Product Uploaded';
            }
            else echo 'Product Not Uploaded';

        }
    ?>
    <h2>Create Product</h2>

    <form action="" method="POST" enctype="multipart/form-data">
            
        <p> Name: <input type="text" placeholder="Name" name="name" required=""> </p>
        <p> Type: <input type="text" placeholder="Type" name="type" required=""> </p>
        <p> Image: <input type="file" name="image" required=""> </p>
        
        <p> <input type="submit" name="Submit"> </p>
    </form>
    



    
