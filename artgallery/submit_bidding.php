<?php
include 'db_connection/connection.php';
session_start();
?>

<?php
   
  include 'nav_menu.php';
?>


    
    <?php

          $pId = $_GET['id'];

          
          $sqlquery = "SELECT t1.*, t2.* FROM bid_products as t1 
                       JOIN products as t2 ON t1.product_id = t2.id
                        WHERE t2.id = '$pId'";
          $returnval = $dbcon->query($sqlquery);

          $productInfo = $returnval->fetch();

          if(isset($_POST['Submit']))
          {

            $userId = $_SESSION['userId'];
            $bid_amount = $_POST['price'];
            $product_id = $pId;

            if(date("d-m-Y H:i:s") < date("d-m-Y H:i:s", strtotime($productInfo['end_at'])) || $productInfo['end_at'] == null) 
            {

              $sqlquery = "INSERT INTO bid_reports (id, product_id, customer_id, bid_amount) VALUES (NULL, '$product_id', '$userId', '$bid_amount')";
              $returnVal = $dbcon->exec($sqlquery);
            }


          }

          $sqlquery = "SELECT max(bid_amount) as bid_amount FROM bid_reports WHERE product_id = '$pId'";
          $returnval = $dbcon->query($sqlquery);
          $bidInfo = $returnval->fetch();

          $bidAmount = $bidInfo['bid_amount'];
          $sqlquery = "SELECT t2.name, t2.email FROM bid_reports as t1 
                       JOIN users as t2 ON t1.customer_id = t2.id
                       WHERE t1.product_id = '$pId' AND t1.bid_amount = '$bidAmount'";
          $returnval = $dbcon->query($sqlquery);
          $customerInfo = $returnval->fetch();

          

    ?>
            

    <h2>Bidding Products Info</h2>
    
    <h1><?php echo $productInfo['name'] ?><h1>
    <img width="200" height="200" alt="Product Demo" src="<?php echo $productInfo['image'] ?>">
    <h4>Price: <?php echo $productInfo['price'] ?></h4>
    <h4>Max Price: <?php echo ($bidInfo['bid_amount']) ? $bidInfo['bid_amount'] : 0; ?></h4>
    <h4>Customer Name: <?php echo ($customerInfo['name']) ? $customerInfo['name'] : 'None'; ?></h4>
    <h4>Customer Email: <?php echo ($customerInfo['email']) ? $customerInfo['email'] : 'None'; ?></h4>


    <?php if(date("d-m-Y H:i:s") < date("d-m-Y H:i:s", strtotime($productInfo['end_at'])) || $productInfo['end_at'] == null) { ?>
      <form action="" method="POST">
          <p> Price: <input type="text" placeholder="Price" name="price" required=""> </p>
          <p> <input type="submit" name="Submit"> </p>
      </form>
    <?php } ?>


    

    
