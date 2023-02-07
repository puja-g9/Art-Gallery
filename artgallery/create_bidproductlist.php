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
            $painter_id = $_SESSION['userId'];
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
            
            $product_id = $_POST['product_id'];
            $price = $_POST['price'];
            $time_duration = $_POST['time_duration'];
            $description = $_POST['description'];
            $created_at = date("Y-m-d H:i:s");

            
            $sqlquery = "INSERT INTO bid_products (id, product_id, price, description, time_duration, created_at) VALUES (NULL, '$product_id', '$price', '$description', '$time_duration', '$created_at')";
            $returnVal1 = $dbcon->exec($sqlquery);

            if($returnVal1 == 1)
            {
              $sqlquery = "UPDATE products SET bid_status = 1 WHERE id = '$product_id'";
              $returnVal2 = $dbcon->exec($sqlquery);
            }

            if($returnVal2 == 1 )
            {
              echo 'Bid Product Uploaded';
            }
            else echo 'Bid Product Not Uploaded';

        }

        $sqlquery = "SELECT * FROM products WHERE painter_id = '$painter_id' AND bid_status = 0";
        $returnval = $dbcon->query($sqlquery);

        $productList = $returnval->fetchAll();
    ?>
    <h2>Create Bid Product</h2>

    <form action="" method="POST">
            
        <p> Product: <select name="product_id" required="">
        	<option value="">Select Product</option>
        	<?php foreach($productList as $product) { ?>
					  <option value="<?php echo $product['id'] ?>"><?php echo $product['name']; ?></option>
			<?php } ?>		  
				</select> 
		</p>

        <p> Price: <input type="text" placeholder="Price" name="price" required=""> </p>

        <p> Description <textarea name="description" required=""> </textarea> <p>
        
         <p> Time Duration: 
         	<select name="time_duration" required="">
        		<option value="">Select Time Duration</option>
        		<option value="1">1 Hour</option>
        		<option value="2">2 Hour</option>
        	</select> 
		</p>
        <p> <input type="submit" name="Submit"> </p>
    </form>
    



    
