<?php
include 'auth.php';
if (!isAdmin()) {
    echo "<script>alert('Access denied: Only admin can access staff page'); window.location='index.php';</script>";
    exit();
}
include_once 'database.php';
include_once 'staffs_crud.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>GAP STYLE Ordering System: Staffs</title>
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
  <div class="card shadow">
  <div class="card-body">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create New Staff</h2>
        </div>

        <form action="staffs.php" method="post" class="form-horizontal">

        <!--Staff ID-->   
        <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">Staff ID</label>
          <div class="col-sm-9">
            <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_id']; ?>"  required>
          </div>
        </div>

        <!--Staff Name-->
         <div class="form-group">
          <label for="staffname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input name="name" type="text" class="form-control" id="staffname" placeholder="Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>"  required>
          </div>
        </div>

        <!--Staff Phone Number-->
        <div class="form-group">
          <label for="staffphonenumber" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
            <input name="phone" type="text" class="form-control" id="staffphonenumeber" placeholder="Phone Number"
            pattern="^[0-9]{3}-[0-9]{7,8}$"
            oninvalid="this.setCustomValidity('Phone format must be xxx-xxxxxxx')"
            oninput="this.setCustomValidity('')"
            value="<?php if(isset($_GET['edit'])) echo $editrow['fld_phone']; ?>"
            required>
          </div>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
            <input name="password" type="password" class="form-control" id="password" placeholder="Password" <?php if(isset($_GET['edit'])) echo "readonly"; ?> required>
          </div>
        </div>

        <!-- User Level -->
        <div class="form-group">
          <label for="userlevel" class="col-sm-3 control-label">User Level</label>
          <div class="col-sm-9">
            <select name="user_level" class="form-control" required>
              <option value="">-- Select --</option>
              <option value="admin" <?php if(isset($_GET['edit']) && $editrow['fld_user_level']=="admin") echo "selected"; ?>>Admin</option>
              <option value="non-admin" <?php if(isset($_GET['edit']) && $editrow['fld_user_level']=="non-admin") echo "selected"; ?>>Non-Admin</option>
            </select>
          </div>
        </div>

        <!--Button-->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_id']; ?>">
              <button class="btn btn-success" type="submit" name="update">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update
              </button>
            <?php } else { ?>
              <button class="btn btn-primary" type="submit" name="create">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create
              </button>
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

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Staffs List</h2>
      </div>
      <table class="table table-striped table-bordered"> 
        <thead>
          <tr>
            <th>Staff ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>User Level</th>
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

          // Get staff list using functions from staffs_crud.php
          $result = getStaffList($page, $per_page);
          $total_records = countTotalStaff();
          
          if(!empty($result)){
            foreach($result as $readrow) {
          ?>
            <tr>
              <td><?php echo $readrow['fld_staff_id']; ?></td>
              <td><?php echo $readrow['fld_staff_name']; ?></td>
              <td><?php echo $readrow['fld_phone']; ?></td>
              <td><?php echo $readrow['fld_user_level']; ?></td>
              <td>
                <a href="staffs.php?edit=<?php echo $readrow['fld_staff_id']; ?>" class="btn btn-success btn-xs" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                <a href="staffs.php?delete=<?php echo $readrow['fld_staff_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span> Delete</a>
              </td>
            </tr>
            <?php 
          }
        } else {
          echo "<tr><td colspan='5'>No staff records found.</td></tr>";
        }
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
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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