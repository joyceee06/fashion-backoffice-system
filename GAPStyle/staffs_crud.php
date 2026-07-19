<?php
 
$servername = "lrgs.ftsm.ukm.my";
$username = "a201392";
$password = "smallblueturtle";
$dbname = "a201392";
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare(
      "INSERT INTO tbl_staffs_a201392_pt2(fld_staff_id, fld_staff_name, fld_phone, fld_password, fld_user_level)
      VALUES(:sid, :name, :phone, :password, :user_level)"
    );
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':user_level', $user_level, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);
    $user_level = $_POST['user_level'];
         
    $stmt->execute();

    header("Location: staffs.php");
    exit();

  }catch(PDOException $e){
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare(
      "UPDATE tbl_staffs_a201392_pt2 SET
      fld_staff_id = :sid, 
      fld_staff_name = :name, 
      fld_phone = :phone, 
      fld_user_level = :user_level
      WHERE fld_staff_id = :oldsid"
    );
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
    $stmt->bindParam(':user_level', $user_level, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $user_level = $_POST['user_level'];
    $oldsid = $_POST['oldsid'];
         
    $stmt->execute();
 
    header("Location: staffs.php");
    exit();

  }catch(PDOException $e){
    echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {

    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a201392_pt2 where fld_staff_id = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
    exit();

  }catch(PDOException $e){
    echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a201392_pt2 where fld_staff_id = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);

  }catch(PDOException $e){
      echo "Error: " . $e->getMessage();
  }
}

// Function to get staff list for display
function getStaffList($page = 1, $per_page = 5) {
    global $conn;
    
    $start_from = ($page - 1) * $per_page;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a201392_pt2 ORDER BY fld_staff_id LIMIT :start, :per_page");
        $stmt->bindParam(':start', $start_from, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $per_page, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

// Function to count total staff
function countTotalStaff() {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_staffs_a201392_pt2");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0;
    }
}
 
?>