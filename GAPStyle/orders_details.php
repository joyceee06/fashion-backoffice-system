<?php
include 'auth.php';
include_once 'orders_details_crud.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GAP STYLE Ordering System: Order Details</title>
  <!-- Bootstrap & Theme -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/app-theme.css" rel="stylesheet">
  
  <style>
    /* Cards styling */
    .dashboard-card {
      background-color: var(--white);
      padding: 25px;
      border-radius: 14px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      margin-top: 30px;
    }

    .dashboard-title {
      color: var(--primary);
      font-weight: 700;
      margin-bottom: 20px;
      text-align: center;
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 8px rgba(28,77,141,0.2);
    }

    .btn-primary {
      background-color: var(--primary);
      border-color: var(--primary);
      font-weight: 600;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background-color: var(--dark);
      border-color: var(--dark);
    }

    .btn-danger {
      border-radius: 8px;
    }

    /* Table styling */
    .table thead th {
      background-color: var(--primary);
      color: var(--white);
      text-align: center;
      border: 1px solid var(--primary);
    }

    .table tbody td {
      text-align: center;
      vertical-align: middle;
      border: 1px solid var(--primary);
    }

    .table-hover tbody tr:hover {
      background-color: rgba(148,180,193,0.2);
    }

    /* Page header spacing */
    .page-header {
      margin-top: 30px;
      margin-bottom: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
      .dashboard-card {
        padding: 20px;
      }
    }

    /* Order Details Table */
    .order-details-table {
      border: 1px solid var(--primary);
      border-radius: 8px;               
      width: 100%;
      border-collapse: separate;   
      border-spacing: 0;
    }

    .order-details-table td {
      padding: 10px 15px;
      text-align: left;
    }


  </style>
</head>

<body>
  <?php include_once 'nav_bar.php'; ?>

  <?php
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM tbl_orders_a201392_pt2, tbl_staffs_a201392_pt2, tbl_customers_a201392_pt2 
      WHERE tbl_orders_a201392_pt2.fld_staff_id = tbl_staffs_a201392_pt2.fld_staff_id 
      AND tbl_orders_a201392_pt2.fld_customer_id = tbl_customers_a201392_pt2.fld_customer_id 
      AND fld_order_num = :oid");
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $oid = $_GET['oid'];
    $stmt->execute();
    $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  ?>

  <div class="container">

    <!-- Order Summary Card -->
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="dashboard-card">
          <h3 class="dashboard-title">Order Details</h3>
            <table class="table order-details-table">
              <tr>
                <td><strong>Order ID</strong></td>
                <td><?php echo $readrow['fld_order_num'] ?></td>
              </tr>
              <tr>
                <td><strong>Order Date</strong></td>
                <td><?php echo $readrow['fld_order_date'] ?></td>
              </tr>
              <tr>
                <td><strong>Staff</strong></td>
                <td><?php echo $readrow['fld_staff_name'] ?></td>
              </tr>
              <tr>
                <td><strong>Customer</strong></td>
                <td><?php echo $readrow['fld_customer_name'] ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>

    <!-- Add Product Card -->
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="dashboard-card">
          <h3 class="dashboard-title">Add a Product</h3>
          <form action="orders_details.php" method="post" class="form-horizontal" name="frmorder" id="forder" onsubmit="return validateForm();">
            <div class="form-group">
              <label for="prd" class="col-sm-3 control-label">Product</label>
              <div class="col-sm-9">
                <select name="pid" class="form-control" id="prd">
                  <option value="">Please select</option>
                  <?php
                  try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT * FROM tbl_products_a201392_pt2");
                    $stmt->execute();
                    $products = $stmt->fetchAll();
                  } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                  }
                  foreach($products as $productrow) {
                    echo '<option value="'.$productrow['fld_product_id'].'">'.$productrow['fld_category'].' '.$productrow['fld_product_name'].'</option>';
                  }
                  $conn = null;
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="qty" class="col-sm-3 control-label">Quantity</label>
              <div class="col-sm-9">
                <input name="quantity" type="number" class="form-control" id="qty" min="1">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <input name="oid" type="hidden" value="<?php echo $readrow['fld_order_num'] ?>">
                <button class="btn btn-primary" type="submit" name="addproduct">
                  <span class="glyphicon glyphicon-plus"></span> Add Product
                </button>
                <button class="btn btn-default" type="reset">
                  <span class="glyphicon glyphicon-erase"></span> Clear
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Products Table Card -->
    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="dashboard-card">
          <h3 class="dashboard-title">Products in This Order</h3>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Order Detail ID</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a201392_pt2, tbl_products_a201392_pt2 
                    WHERE tbl_orders_details_a201392_pt2.fld_product_id = tbl_products_a201392_pt2.fld_product_id 
                    AND fld_order_num = :oid");
                  $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
                  $oid = $_GET['oid'];
                  $stmt->execute();
                  $orderDetails = $stmt->fetchAll();
                } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                }
                foreach($orderDetails as $detailrow) {
                  ?>
                  <tr>
                    <td><?php echo $detailrow['fld_order_detail_num']; ?></td>
                    <td><?php echo $detailrow['fld_product_name']; ?></td>
                    <td><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
                    <td>
                      <a href="orders_details.php?delete=<?php echo $detailrow['fld_order_detail_num']; ?>&oid=<?php echo $_GET['oid']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                  </tr>
                <?php } $conn=null; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Generate Invoice Button -->
    <div class="row" style="margin-top:30px; margin-bottom: 30px;">
      <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <a href="invoice.php?oid=<?php echo $_GET['oid']; ?>" target="_blank" class="btn btn-primary btn-lg btn-block" >
          Generate Invoice
        </a>
      </div>
    </div>

  </div>

<script>
function validateForm() {
  var x = document.forms["frmorder"]["pid"].value;
  var y = document.forms["frmorder"]["quantity"].value;
  if (!x) {
    alert("Product must be selected");
    document.forms["frmorder"]["pid"].focus();
    return false;
  }
  if (!y) {
    alert("Quantity must be filled out");
    document.forms["frmorder"]["quantity"].focus();
    return false;
  }
  return true;
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
