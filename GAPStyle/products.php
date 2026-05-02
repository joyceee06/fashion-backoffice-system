<?php
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
 
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    body {
      margin: 0;
      background-color: #e7e2fd;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    form label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input, select {
      padding: 10px;
      border: 2px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      width: 100%;
      box-sizing: border-box;
    }

    button {
      padding: 10px 20px;
      min-width: 100px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button[type="submit"] {
      background-color: #28a745;
      color: white;
    }

    button[type="reset"] {
      background-color: red;
      color: white;
    }

    .form-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 10px;
    }

    table {
      width: 90%;
      margin: 30px auto;
      border-collapse: collapse;
      margin-top: 30px;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
      background-color: white;
    }

    th {
      background-color: #ef6f9d;
      color: white;
    }

  </style>
</head>

<body>
  <?php include_once 'nav_bar.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create New Product</h2>
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
          <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
          <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
          <?php } ?>
          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
          </div>
        </div>

        </form>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered">  
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
        // Read
        $per_page = 5;
        if (isset($_GET["page"]))
          $page = $_GET["page"];
        else
          $page = 1;
        $start_from = ($page-1) * $per_page;
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a201392_pt2 LIMIT $start_from, $per_page");
          $stmt->execute();
          $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
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
            <a href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
            <a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
            <a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
          </td>
        </tr>

        <?php }
          $conn = null;
        ?>

        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a201392_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

</body>
</html>