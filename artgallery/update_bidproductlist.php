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

    	$id = $_GET['id'];
        $sqlquery = "SELECT * FROM bid_products WHERE id = '$id'";
        $returnVal = $dbcon->query($sqlquery);

        $productData = $returnVal->fetch();

        if(isset($_POST['Submit']))
        {
            
            $product_id = $_POST['product_id'];
            $price = $_POST['price'];
            $time_duration = $_POST['time_duration'];

            
            $sqlquery = "INSERT INTO bid_products (id, product_id, price, time_duration) VALUES (NULL, '$product_id', '$price', '$time_duration')";
            $returnVal = $dbcon->exec($sqlquery);

            if($returnVal == 1)
            {
              echo 'Bid Product Uploaded';
            }
            else echo 'Bid Product Not Uploaded';

        }

        $sqlquery = "SELECT * FROM products WHERE painter_id = '$painter_id'";
        $returnval = $dbcon->query($sqlquery);

        $productList = $returnval->fetchAll();
    ?>
    <h2>Create Bid Product</h2>

    <form action="" method="POST">
            
        <p> Product: <select name="product_id" required="">
        	<option value="">Select Product</option>
        	<?php foreach($productList as $product) { ?>
					  <option value="<?php echo ($product['id'] == $productData['product_id']) ? 'selected' : '' ?>"><?php echo $product['name']; ?></option>
			<?php } ?>		  
				</select> 
		</p>

        <p> Price: <input type="text" placeholder="Price" name="price" required=""> </p>
        
         <p> Time Duration: 
         	<select name="time_duration" required="">
        		<option value="">Select Time Duration</option>
        		<option value="1">1 Hour</option>
        		<option value="2">2 Hour</option>
        	</select> 
		</p>
        <p> <input type="submit" name="Submit"> </p>
    </form>
    



    
