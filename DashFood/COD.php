<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user2'])){
header("location: customerlogin.php"); 
}

//unset($_SESSION["cart"]);
?>

<html>

  <head>
    <title> DashFood</title>
  </head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="icon" href="images/logo.jpg" type="image/icon type">
  <link rel="stylesheet" type = "text/css" href ="css/COD.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>

  
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Click n Eat</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            <li><a href="contactus.php">Contact Us</a></li>

          </ul>

<?php

if(isset($_SESSION['login_user1'])){

?>


          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="myrestaurant.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
<?php

}
else if (isset($_SESSION['login_user2'])) {

  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Food Zone </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
             (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
              </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        

}
else {

  ?>

<ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="customersignup.php"> User Sign-up</a></li>
              <li> <a href="managersignup.php"> Manager Sign-up</a></li>
              <li> <a href="#"> Admin Sign-up</a></li>
            </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="customerlogin.php"> User Login</a></li>
              <li> <a href="managerlogin.php"> Manager Login</a></li>
              <li> <a href="#"> Admin Login</a></li>
            </ul>
            </li>
          </ul>

<?php

}

?>


        </div>

      </div>
    </nav>



        <div class="container">
          <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Order Placed Successfully.</h1>
          </div>
        </div>
        <br>

<h2 class="text-center"> Thank you for Ordering at DashFood! The ordering process is now complete.</h2>

<?php 
  $num1 = rand(100000,999999); 
  $num2 = rand(100000,999999); 
  $num3 = rand(100000,999999);
  $number = $num1.$num2.$num3;
?>

<h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$number"; ?></span> </h3>

        <?php
if(!empty($_SESSION["cart"]))
{
  ?>
  <div class="container" style="margin-top:3rem;">
        <h3 style="text-align:center;">Your Order details</h3>
      
    </div>
    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
<table class="table table-striped">
  <thead class="thead-dark">
<tr>
<th width="40%">Food Name</th>
<th width="10%">Quantity</th>
<th width="20%">Price Details</th>
<th width="15%">Order Total</th>
</tr>
</thead>


<?php  

$total = 0;
foreach($_SESSION["cart"] as $keys => $values)
{
?>
<tr>
<td><?php echo $values["food_name"]; ?></td>
<td><?php echo $values["food_quantity"] ?></td>
<td>&#36; <?php echo $values["food_price"]; ?></td>
<td>&#36; <?php echo number_format($values["food_quantity"] * $values["food_price"], 2); ?></td>
</tr>
<?php 
$total = $total + ($values["food_quantity"] * $values["food_price"]);
}
?>

</table>

</div>
<?php
}
        ?>
<a href="./foodlist.php" class="btn btn-primary" onclick="thisfunction()" style="margin:2% 46%" role="button">Done</a>

<script type="text/javascript">
function thisfunction(){
    var x = new XMLHttpRequest();
    x.open("GET","function.php",true);
    x.send();
    return false;
}
</script>

  </body>

</html>