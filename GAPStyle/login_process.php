<?php

session_start();

include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sid = $_POST['username'];
$password = md5($_POST['password']);

$stmt = $conn->prepare(
  "SELECT * FROM tbl_staffs_a201392_pt2
  WHERE fld_staff_id = :sid AND fld_password = :password"
);

$stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);

$stmt->execute();
    
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
  $_SESSION['staff_id'] = $user['fld_staff_id'];
  $_SESSION['staff_name'] = $user['fld_staff_name'];
  $_SESSION['user_level'] = $user['fld_user_level'];

  header("Location: index.php");
  exit();
} else {
  echo 
  "<script>alert('Invalid Staff ID or Password'); window.location='login.php';</script>";
}
?>