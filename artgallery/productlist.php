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

            $sqlquery = "SELECT * FROM products WHERE painter_id = '$userId'";
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

    <h2>Products List</h2>
    <a href="createproduct.php">Create Product</a>
    <br><br>



    <table>
      <tr>
        <th>Sl.</th>
        <th>Name</th>
        <th>Product Type</th>
        <th>Purchase Status</th>
        <th>Bid Compeletd Status</th>
        <th>Bid Status</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
        <?php foreach($productList as $key => $data) { ?>
          
          <tr>
            <td><?php echo $key + 1; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['product_type']; ?></td>
            <td><?php echo ($data['purchase_status'] == 0) ? 'No' : 'Yes'; ?></td>
            <td><?php echo ($data['bid_completed_status'] == 0) ? 'No' : 'Yes'; ?></td>
            <td><?php echo ($data['bid_status'] == 0) ? 'No' : 'Yes'; ?></td>
            <td><img width="80" height="80" alt="Product Demo" src="<?php echo $data['image'] ?>"></td>
            <td>
                <?php if($data['bid_status'] == 0) { ?>
                    <a href="updateproduct.php?pId=<?php echo $data['id']; ?>">Edit</a> || 
                    <a href="deleteproduct.php?pId=<?php echo $data['id']; ?>">Delete</a>
                <?php } ?>
            </td>
          </tr>

        <?php } ?>
    </table>
