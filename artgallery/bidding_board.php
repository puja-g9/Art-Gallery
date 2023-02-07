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

            $userId = $_SESSION['userId'];

            if($_SESSION['usertype'] == 'painter')
            {
               $sqlquery = "SELECT t1.*, t2.* FROM bid_products as t1 
                            JOIN products as t2 ON t1.product_id = t2.id
                            WHERE t2.painter_id = '$userId'";
               $returnval = $dbcon->query($sqlquery);
            }
            else
            {
               $sqlquery = "SELECT t1.*, t2.* FROM bid_products as t1 
                            JOIN products as t2 ON t1.product_id = t2.id";
               $returnval = $dbcon->query($sqlquery);
            }
            
            $productList = $returnval->fetchAll();
        
    ?>
            

    <h2>Products List</h2>
    
    <br><br>



    <table>
      <tr>
        <th>Sl.</th>
        <th>Name</th>
        <th>Product Type</th>
        <th>Description</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
        <?php foreach($productList as $key => $data) { 
                
        ?>
          
          <tr>
            <td><?php echo $key + 1; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['product_type']; ?></td>
            <td><?php echo $data['description']; ?></td>
            <td><?php echo ($data['start_at']) ? 'Date : '.date("d-M-Y", strtotime($data['start_at'])).'<br>Time: '.date("H:i:s", strtotime($data['start_at'])) : 'Not Start Yet'; ?></td>
            <td><?php echo ($data['end_at']) ? 'Date : '.date("d-M-Y", strtotime($data['end_at'])).'<br>Time: '.date("H:i:s", strtotime($data['end_at'])) : 'Not Start Yet'; ?></td>
            <td><img width="80" height="80" alt="Product Demo" src="<?php echo $data['image'] ?>"></td>
            <td>
              <?php if($data['start_at']) { ?>
                <a href="submit_bidding.php?id=<?php echo $data['product_id']; ?>">Bidding</a>
              <?php } ?>
            </td>
          </tr>

        <?php } ?>
    </table>

    
