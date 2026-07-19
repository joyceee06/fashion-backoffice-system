<?php
include_once 'database.php';

if (isset($_GET['pid']) && !empty($_GET['pid'])) {

    $pid = $_GET['pid'];

    try {
        $conn = new PDO(
            "mysql:host=$servername;dbname=$dbname",
            $username,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $stmt = $conn->prepare(
            "SELECT * FROM tbl_products_a201392_pt2 WHERE fld_product_id = :pid"
        );
        $stmt->bindParam(':pid', $pid);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {

            $imagePath = "products/" . $product['fld_product_id'] . ".jpg";
            if (!file_exists($imagePath)) {
                $imagePath = "products/nophoto.jpg";
            }
?>
<div class="product-modal-wrapper">

  <div class="row">

    <!-- PRODUCT IMAGE -->
    <div class="col-xs-12 col-sm-5 text-center">
      <img src="<?= $imagePath ?>"
           class="product-modal-image img-responsive center-block"
           alt="<?= htmlspecialchars($product['fld_product_name']) ?>">

      <h4 class="product-modal-title">
        <?= htmlspecialchars($product['fld_product_name']) ?>
      </h4>
    </div>

    <!-- PRODUCT SPEC TABLE -->
    <div class="col-xs-12 col-sm-7">
      <div class="product-spec-card">

        

        <table class="table table-bordered product-spec-table">
            <div class="product-spec-header">
                Product Specifications
            </div>

          <tbody>
            <tr>
              <th>Product ID</th>
              <td><?= htmlspecialchars($product['fld_product_id']) ?></td>
            </tr>

            <tr>
              <th>Price</th>
              <td class="product-price">
                RM <?= number_format($product['fld_product_price'], 2) ?>
              </td>
            </tr>

            <tr>
              <th>Category</th>
              <td><?= htmlspecialchars($product['fld_category']) ?></td>
            </tr>

            <tr>
              <th>Size</th>
              <td><?= htmlspecialchars($product['fld_size']) ?></td>
            </tr>

            <tr>
              <th>Colour</th>
              <td><?= htmlspecialchars($product['fld_colour']) ?></td>
            </tr>

            <tr>
              <th>Material</th>
              <td><?= htmlspecialchars($product['fld_material']) ?></td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>

  </div>

</div>

<?php
        } else {
            echo '<div class="alert alert-warning text-center">Product not found</div>';
        }

        $conn = null;

    } catch (PDOException $e) {
        echo '<div class="alert alert-danger text-center">Database error</div>';
    }

} else {
    echo '<div class="alert alert-danger text-center">No product selected</div>';
}
?>
