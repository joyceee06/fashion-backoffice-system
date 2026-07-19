<?php
include 'auth.php';
redirectIfNoAccess('products', 'read');
include_once 'database.php';
include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>GAP STYLE Ordering System: Product</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/app-theme.css" rel="stylesheet">
  <!-- DataTables Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap.min.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  
  <?php include_once 'nav_bar.php'; ?>

  <!-- Only show create form if user has create permission -->
  <?php if (canAccess('products', 'create')): ?>

  <div class="container">
  <div class="card shadow">
  <div class="card-body">

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2><?php echo isset($_GET['edit']) ? 'Edit Product' : 'Create New Product'; ?></h2>
        </div>

        <form action="products.php" method="post" class="form-horizontal">

        <!--Product ID-->
        <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">Product ID </label>
          <div class="col-sm-9">
            <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; ?>" required>
          </div>
        </div>

        <!--Product Name-->
        <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
          </div>
        </div>

        <!--Product Price-->
        <div class="form-group">
          <label for="productprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
            <input name="price" type="number" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" min="0.0" step="0.01" required>
          </div>
        </div>

        <!--Product Category-->
        <div class="form-group">
          <label for="productcategory" class="col-sm-3 control-label">Category</label>
          <div class="col-sm-9">
          <select name="category" class="form-control" id="productcategory" required>
            <option value="">Please select</option>
            <option value="T-Shirts"<?php if(isset($_GET['edit'])) if($editrow['fld_category']=="T-Shirts") echo "selected"; ?>>T-Shirts</option>
            <option value="Dresses"<?php if(isset($_GET['edit'])) if($editrow['fld_category']=="Dresses") echo "selected"; ?>>Dresses</option>
            <option value="Pants"<?php if(isset($_GET['edit'])) if($editrow['fld_category']=="Pants") echo "selected"; ?>>Pants</option>
            <option value="Shirts"<?php if(isset($_GET['edit'])) if($editrow['fld_category']=="Shirts") echo "selected"; ?>>Shirts</option>
            <option value="Outerwear"<?php if(isset($_GET['edit'])) if($editrow['fld_category']=="Outerwear") echo "selected"; ?>>Outerwear</option>
            <option value="Hats & Caps"<?php if(isset($_GET['edit'])) if($editrow['fld_category']=="Hats & Caps") echo "selected"; ?>>Hats & Caps</option>
            <option value="Bags"<?php if(isset($_GET['edit'])) if($editrow['fld_category']=="Bags") echo "selected"; ?>>Bags</option>
          </select>
          </div>
        </div>

        <!--Product Size-->
        <div class="form-group">
          <label for="productsize" class="col-sm-3 control-label">Size</label>
          <div class="col-sm-9">
          <input name="size" type="text" class="form-control" id="productsize" placeholder="Product Size" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_size']; ?>"  required>
          </div>
        </div>

        <!--Product Colour-->
        <div class="form-group">
          <label for="productcolor" class="col-sm-3 control-label">Colour</label>
          <div class="col-sm-9">
          <input name="colour" type="text" class="form-control" id="productcolor" placeholder="Product Colour" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_colour']; ?>"  required>
          </div>
        </div>

        <!--Product Material-->
        <div class="form-group">
          <label for="productmaterial" class="col-sm-3 control-label">Material</label>
          <div class="col-sm-9">
          <input name="material" type="text" class="form-control" id="productmaterial" placeholder="Product Material" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_material']; ?>"  required>
          </div>
        </div>

        <!--Button-->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_id']; ?>">
              <button type="submit" name="update" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
            <?php } else { ?>
              <button  type="submit" name="create" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
            <?php } ?>
            <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
          </div>
        </div>

        </form>
      </div>
    </div>

  </div>
  </div>
  </div>

  <?php endif; ?>
  
  <!-- Products List (Visible to all with read permission) -->
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>

      <table id="productsTable" class="table table-striped table-bordered table-hover">


        <thead>
          <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Size</th>
            <th>Colour</th>
            <th>Material</th>
            <th>Actions</th>
          </tr>
        </thead>
      
        <tbody>
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a201392_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
          }
          catch(PDOException $e){
            echo "<tr><td colspan='8'>Error loading products</td></tr>";
          }
          foreach($result as $readrow) {
            ?>
            <tr>
              <td><?php echo $readrow['fld_product_id']; ?></td>
              <td><?php echo $readrow['fld_product_name']; ?></td>
              <td><?php echo $readrow['fld_product_price']; ?></td>
              <td><?php echo $readrow['fld_category']; ?></td>
              <td><?php echo $readrow['fld_size']; ?></td>
              <td><?php echo $readrow['fld_colour']; ?></td>
              <td><?php echo $readrow['fld_material']; ?></td>
              <td>
                <button class="btn btn-warning btn-xs btn-product-details" 
                  data-product-id="<?php echo $readrow['fld_product_id'];?>">
                  <span class="glyphicon glyphicon-eye-open"></span> 
                  Details
                </button>

                <?php if (canAccess('products', 'update')): ?>
                  <a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-success btn-xs" role="button">
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit
                  </a>
                <?php endif; ?>
                <?php if (canAccess('products', 'delete')): ?>
                  <a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">
                    <span class="glyphicon glyphicon-trash"></span>
                    Delete
                  </a>
                <?php endif; ?>
              </td>
            </tr>
          <?php } $conn = null; ?>
        </tbody>

      </table>  
    </div>
  </div>

  <!-- Bootstrap Modal for Product Details -->
  <div class="modal fade" id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="productModalLabel">Product Details</h4>
        </div>
        <div class="modal-body" id="productDetailsContent">
          <!-- Content will be loaded here -->
          <div class="text-center">
            <p>Loading product details...</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

  <!-- JavaScript for handling modal -->
  <script>
    $(document).ready(function() {
      // When Details button is clicked
      $('.btn-product-details').click(function() {
        var productId = $(this).data('product-id');
        var productName = $(this).data('product-name');
        
        // Set modal title
        $('#productModalLabel').text('Product Details');
        
        // Show loading message
        $('#productDetailsContent').html(
          '<div class="text-center">' +
          '<span class="glyphicon glyphicon-refresh spinning"></span>' +
          '<p>Loading product details...</p>' +
          '</div>'
        );
        
        // Show the modal
        $('#productDetailsModal').modal('show');
        
        // Load product details via AJAX
        $.ajax({
          url: 'get_product_details_modal.php',
          type: 'GET',
          data: { pid: productId },
          dataType: 'html',
          success: function(response) {
            $('#productDetailsContent').html(response);
          },
          error: function(xhr, status, error) {
            $('#productDetailsContent').html(
              '<div class="alert alert-danger">' +
                '<strong>Error!</strong> Could not load product details. Please try again.<br>' +
                'Error: ' + error +
              '</div>'
            );
          }
        });
      });
    });
  </script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script>

  <!-- DataTables Buttons (Excel export) -->
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#productsTable').DataTable({
        order: [[1, 'asc']], // Name column ascending
        lengthMenu: [
          [5, 10, 20, 30, -1],
          [5, 10, 20, 30, "All"]
        ],
        pageLength: 5,
        dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>rtipB',
        buttons: [
          {
            extend: 'excelHtml5',
            text: 'Export to Excel',
            className: 'btn btn-success'
          }
        ]
      });
    });
  </script>


</body>
</html>