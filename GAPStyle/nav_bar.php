
<nav class="navbar navbar-default" style="margin-bottom:0; border-radius:0; background-color: var(--primary); border: none;">
  <div class="container-fluid">
    <!-- Brand and toggle -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar" style="background-color: var(--white);"></span>
        <span class="icon-bar" style="background-color: var(--white);"></span>
        <span class="icon-bar" style="background-color: var(--white);"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="color: var(--white); font-weight:700;">GAP STYLE</a>
    </div>

    <!-- Nav links -->
    <div class="collapse navbar-collapse" id="navbar-collapse-main">
      <ul class="nav navbar-nav">
        <li><a href="index.php" style="color: var(--white); font-weight:500;">Home</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['staff_name'])): ?>
          <li class="navbar-text" style="color: var(--white);">
            Welcome, <strong><?php echo $_SESSION['staff_name']; ?></strong>
          </li>
        <?php endif; ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: var(--white); font-weight:500;">
            Menu <span class="caret" style="border-top-color: var(--white);"></span>
          </a>
          <ul class="dropdown-menu">
            <?php if (isset($_SESSION['staff_id']) && canAccess('products', 'read')): ?>
              <li><a href="products.php">Products</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['staff_id']) && isAdmin()): ?>
              <li><a href="staffs.php">Staffs</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['staff_id']) && canAccess('customers', 'read')): ?>
              <li><a href="customers.php">Customers</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['staff_id']) && canAccess('orders', 'read')): ?>
              <li><a href="orders.php">Orders</a></li>
            <?php endif; ?>

            <li role="separator" class="divider"></li>
            <li><a href="logout.php" style="color: var(--dark); font-weight:500;">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<style>
/* Dropdown menu styling */
.dropdown-menu {
  background-color: var(--white); /* menu background white */
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  padding: 0; /* remove extra padding if needed */
  min-width: 180px;
}

/* Dropdown links */
.dropdown-menu > li > a {
  color: var(--dark) !important; /* dark text */
  font-weight: 500;
  padding: 10px 20px;
  display: block;
  white-space: nowrap;
}

/* Dropdown link hover */
.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus {
  background-color: var(--accent);
  color: var(--white) !important;
}

/* Divider */
.dropdown-menu > li.divider {
  background-color: #ddd;
  height: 1px;
  margin: 5px 0;
  overflow: hidden;
}

/* Keep open dropdown item highlighted */
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
  background-color: var(--primary);
  color: var(--white) !important;
}
</style>



