<style>
body {font-family: Arial, Helvetica, sans-serif;}

.navbar {
  width: 100%;
  background-color: #555;
  overflow: auto;
}

.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background-color: #000;
}

.active {
  background-color: #4CAF50;
}

@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
</style>

<div class="navbar">


  <?php if($_SESSION['usertype'] == 'painter') { ?>
	  <a href="productlist.php"><i class="fa fa-fw fa-PRODUCTS"></i> SET PRODUCT  </a>
	  <a href="bidproductlist.php"><i class="fa fa-fw fa-PRODUCT FOR BIDDING"></i>PRODUCTS FOR BIDDING  </a> 
  <?php } ?>

 	<a href="bidding_board.php"><i class="fa fa-fw fa-GO FOR BIDDING"></i>BIDDING BOARD </a> 
  	<a id="logoutbtn"><i class="fa fa-fw fa-PRODUCT FOR BIDDING"></i>LOG OUT</a>

</div>

<script>
    var elm=document.getElementById('logoutbtn');
    elm.addEventListener('click', processlogout);
    
    function processlogout(){
        window.location.assign('logoutprocess.php');
    }
    
</script>