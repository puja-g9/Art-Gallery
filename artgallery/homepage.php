<?php
  include 'db_connection/connection.php';
   session_start();
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php
   
  include 'nav_menu.php';
?>

<?php
   
    

    if(isset($_SESSION['useremail']) && !empty($_SESSION['useremail'])){
        ?>  
            <br>
            <p style="text-align: center;">Welcome <?php echo $_SESSION['useremail'] ." As ". $_SESSION['usertype'] ;  ?></p>
            
            <h1 style="text-align: center;"> <b> Welcome to Art Geek </b> </h1>
            
        <?php
    }
    else{
        ///session doesn't contain any valid user email
        ?>
            <script>
                window.location.assign('login.php');
            </script>
        <?php
    }
?>
</html> 