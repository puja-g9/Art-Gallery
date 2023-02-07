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

        $productId = $_GET['pId'];
        $sqlquery = "SELECT * FROM products WHERE id = '$productId'";
        $returnVal = $dbcon->query($sqlquery);

        $productData = $returnVal->fetch();

        if(isset($_POST['Update']))
        {
            
            $name = $_POST['name'];
            $type = $_POST['type'];
          
            $painter_id = $_SESSION['userId'];

            if(isset($_FILES['image']))
            {

                $image = $_FILES['image'];
                move_uploaded_file($image['tmp_name'],"images/$name.png");
            }

            $sqlquery = "UPDATE products SET name = '$name', product_type = '$type', painter_id = '$painter_id', image = 'images/$name.png', purchase_status ='0', bid_completed_status = '0' WHERE id = '$productId'";
            $returnVal = $dbcon->exec($sqlquery);

            if($returnVal == 1)
            {
              echo 'Product Updated';
            }
            else echo 'Product Not Updated';

        }
    ?>
    <h2>Update Product</h2>

    <form action="" method="POST" enctype="multipart/form-data">
            
        <p> Name: <input type="text" placeholder="Name" name="name" required="" value="<?php echo $productData['name'] ?>"> </p>
        <p> Type: <input type="text" placeholder="Type" name="type" required="" value="<?php echo $productData['product_type'] ?>"> </p>
       
        <p> Image: <input type="file" name="image"> </p>
        
        <p> <input type="submit" name="Update"> </p>
    </form>
    



    
