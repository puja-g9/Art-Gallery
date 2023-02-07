<?php
include 'db_connection/connection.php';
session_start();
?>

<?php
   
  include 'nav_menu.php';
?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    
    <?php

        if($_SESSION['usertype'] == 'painter')
        {
            $userId = $_SESSION['userId'];

            $sqlquery = "SELECT p.name, bp.price, bp.id as id, p.id as productId, bp.created_at, bp.start_at, 
                        bp.end_at, bp.time_duration
                        FROM products as p JOIN bid_products as bp 
                        ON p.id = bp.product_id WHERE p.painter_id = '$userId'";
            $returnval = $dbcon->query($sqlquery);

            $productList = $returnval->fetchAll();
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

    <h2>Bid Products List</h2>
    <a href="create_bidproductlist.php">Create Bid Product</a>
    <br><br>

    <table>
      <tr>
        <th>Sl.</th>
        <th>Name</th>
        <th>Price</th>
        <th>Set Time</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Action</th>
      </tr>
        <?php foreach($productList as $key => $data) { ?>
          
          <tr>
            <td><?php echo $key + 1; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['price']; ?></td>
            <td><?php echo 'Date : '.date("d-M-Y", strtotime($data['created_at'])).'<br>Time: '.date("H:i:s", strtotime($data['created_at'])); ?></td>
            <td><?php echo ($data['start_at']) ? 'Date : '.date("d-M-Y", strtotime($data['start_at'])).'<br>Time: '.date("H:i:s", strtotime($data['start_at'])) : 'Not Start Yet'; ?></td>
            <td><?php echo ($data['end_at']) ? 'Date : '.date("d-M-Y", strtotime($data['end_at'])).'<br>Time: '.date("H:i:s", strtotime($data['end_at'])) : 'Not Start Yet'; ?></td>
            <td> 
                <?php if(!$data['start_at']) { ?>
                  <a href="delete_bidproductlist.php?id=<?php echo $data['id']; ?>&pId=<?php echo $data['productId']; ?>">Delete</a>
                  || <a href="startBidProduct.php?id=<?php echo $data['id']; ?>&t=<?php echo $data['time_duration']; ?>">Start</a>
                <?php } ?>
            </td>
          </tr>

        <?php } ?>
    </table>
