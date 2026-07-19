<?php
include 'auth.php';
include_once 'database.php';
?>

<?php
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch order, staff, and customer info
    $stmt = $conn->prepare("
        SELECT * FROM tbl_orders_a201392_pt2
        JOIN tbl_staffs_a201392_pt2 ON tbl_orders_a201392_pt2.fld_staff_id = tbl_staffs_a201392_pt2.fld_staff_id
        JOIN tbl_customers_a201392_pt2 ON tbl_orders_a201392_pt2.fld_customer_id = tbl_customers_a201392_pt2.fld_customer_id
        WHERE tbl_orders_a201392_pt2.fld_order_num = :oid
    ");
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $oid = $_GET['oid'];
    $stmt->execute();
    $readrow = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch order details and products
    $stmt = $conn->prepare("
        SELECT * FROM tbl_orders_details_a201392_pt2
        JOIN tbl_products_a201392_pt2 ON tbl_orders_details_a201392_pt2.fld_product_id = tbl_products_a201392_pt2.fld_product_id
        WHERE fld_order_num = :oid
    ");
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->execute();
    $orderDetails = $stmt->fetchAll();

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GAP STYLE Ordering System: Invoice</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/app-theme.css" rel="stylesheet">
<style>
/* Additional custom invoice styling */
.invoice-header h1 {
    font-size: 36px;
    font-weight: 700;
    color: var(--primary);
}
.invoice-header h5 {
    margin: 0;
    font-weight: 500;
}
.table th {
    background-color: var(--primary);
    color: var(--white);
    font-weight: 600;
    text-align: center;
}
.table td {
    vertical-align: middle;
}
.dashboard-card {
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.08);
}
.card-header {
  background-color: var(--primary);
  color: var(--white);
  font-weight: 600;
  padding: 10px 15px;
  border-radius: 12px 12px 0 0; /* rounded top corners */
}

.card-body {
  padding: 15px;
  background-color: var(--white);
  color: var(--dark);
}

</style>
</head>
<body>

<div class="container">

<!-- HEADER -->
<div class="row invoice-header mb-4">
  <div class="col-xs-6">
    <img src="logo.png" width="150" alt="Logo">
  </div>
  <div class="col-xs-6 text-right">
    <h1>INVOICE</h1>
    <h5>Order: <?php echo $readrow['fld_order_num']; ?></h5>
    <h5>Date: <?php echo $readrow['fld_order_date']; ?></h5>
  </div>
</div>
<hr>

<!-- FROM / TO -->
<div class="row">
  <div class="col-xs-5">
    <table class="table table-bordered table-hover mt-4 text-left">
      <thead>
        <th style="text-align:left;"><h4><strong>From: GAP STYLE Sdn. Bhd.</strong></h4></th>
      </thead>
      <tbody>
        <td style="text-align:left;">
          <p>
            Jalan Ampang,<br>
            Kuala Lumpur City Centre,<br>
            50088 Kuala Lumpur,<br>
            Malaysia
          </p>
        </td>
      </tbody>
    </table>
  </div>

  <div class="col-xs-5 col-xs-offset-2">
    <table class="table table-bordered table-hover mt-4 text-left">
      <thead>
        <th style="text-align:left;"><h4><strong>To: <?php echo $readrow['fld_customer_name']; ?></strong></h4></th>
      </thead>
      <tbody>
        <td style="text-align:left;">
          <p>
            Address 1<br>
            Address 2<br>
            Postcode City<br>
            State
          </p>
        </td>
      </tbody>
    </table>
  </div>
</div>

<!-- ORDER DETAILS TABLE -->
<table class="table table-bordered table-hover mt-4">
  <thead>
    <tr>
      <th>No</th>
      <th>Product</th>
      <th class="text-right">Quantity</th>
      <th class="text-right">Price(RM)/Unit</th>
      <th class="text-right">Total(RM)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $grandtotal = 0;
    $counter = 1;
    foreach($orderDetails as $detail):
        $total = $detail['fld_product_price'] * $detail['fld_order_detail_quantity'];
        $grandtotal += $total;
    ?>
    <tr>
      <td><?php echo $counter; ?></td>
      <td><?php echo $detail['fld_product_name']; ?></td>
      <td class="text-right"><?php echo $detail['fld_order_detail_quantity']; ?></td>
      <td class="text-right"><?php echo number_format($detail['fld_product_price'],2); ?></td>
      <td class="text-right"><?php echo number_format($total,2); ?></td>
    </tr>
    <?php $counter++; endforeach; ?>
    <tr>
      <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
      <td class="text-right"><strong>RM <?php echo number_format($grandtotal,2); ?></strong></td>
    </tr>
  </tbody>
</table>

<!-- BANK AND CONTACT DETAILS -->
<div class="row mt-4">
  <!-- Bank Details -->
  <div class="col-xs-5">
    <table class="table table-bordered table-hover text-left">
      <thead>
        <tr>
          <th style="text-align:left;"><h4><strong>Bank Details</strong></h4></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align:left;">
            <p>
              Your Name<br>
              Bank Name<br>
              SWIFT:<br>
              Account Number:<br>
              IBAN:
            </p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Contact Details -->
  <div class="col-xs-7">
    <table class="table table-bordered table-hover text-left">
      <thead>
        <tr>
          <th style="text-align:left;"><h4><strong>Contact Details</strong></h4></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align:left;">
            <p>Staff: <?php echo $readrow['fld_staff_name']; ?></p>
            <p>Phone Number: <?php echo $readrow['fld_phone']; ?></p><br>
            <p><i>Computer-generated invoice. No signature is required.</i></p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
