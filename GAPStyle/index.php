<!--
Matric Number: A201392
Name: Chou Kar Mei
-->
<?php
include 'auth.php'; // start session and check login
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>GAP Style Ordering System</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/app-theme.css" rel="stylesheet">
 
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>

<body>

  <?php include_once 'nav_bar.php'; ?>

  <div class="container">

  <div class="card text-center">

    <img src="logo.png"
         alt="GAP Style Logo"
         style="max-width:250px; margin:0 auto 15px;">

    <h2 class="welcome-title">Welcome to GAP STYLE</h2>

    <p class="welcome-subtitle">
      GAP STYLE Ordering System helps manage products, orders,
      customers and staffs efficiently.
    </p>

    <hr style="margin:25px 0;">

    <div class="row">

      <div class="col-sm-3 <?php if (!isAdmin()) echo 'col-sm-offset-3'; ?>">
        <a href="products.php" class="dashboard-link">
          <div class="dashboard-card">
            <span class="glyphicon glyphicon-tags dashboard-icon"></span>
            <h4 class="dashboard-title">Products</h4>
            <p class="dashboard-text">Manage inventory</p>
          </div>
        </a>
      </div>

      <div class="col-sm-3">
        <a href="orders.php" class="dashboard-link">
          <div class="dashboard-card">
            <span class="glyphicon glyphicon-shopping-cart dashboard-icon"></span>
            <h4 class="dashboard-title">Orders</h4>
            <p class="dashboard-text">Track and manage customer orders</p>
          </div>
        </a>
      </div>

      <?php if (isAdmin()) : ?>

      <div class="col-sm-3">
        <a href="customers.php" class="dashboard-link">
          <div class="dashboard-card">
            <span class="glyphicon glyphicon-user dashboard-icon"></span>
            <h4 class="dashboard-title">Customers</h4>
            <p class="dashboard-text">Manage customer information</p>
          </div>
        </a>
      </div>

      <div class="col-sm-3">
        <a href="staffs.php" class="dashboard-link">
          <div class="dashboard-card">
            <span class="glyphicon glyphicon-briefcase dashboard-icon"></span>
            <h4 class="dashboard-title">Staffs</h4>
            <p class="dashboard-text">Administer staff access and roles</p>
          </div>
        </a>
      </div>

      <?php endif; ?>

    </div>

  </div>

</div>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

</body>
</html>