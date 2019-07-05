<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin-insert</title>
    <style>
    body {
      background-color: #ffffcc;

    }
    button {
     background-color: #4CAF50;
     color: white;
     padding: 14px 20px;
     margin: 8px 0;
     border: none;
     cursor: pointer;
     width: 10%;
    }
    button:hover {
     opacity: 0.8;
    }
    input[type=text], input[type=date] {
     width: 20%;
     padding: 12px 20px;
     margin-left: 9cm;
     margin-bottom: 0.5cm;
     display: inline-block;
     border: 1px solid #ccc;
     box-sizing: border-box;
    }
    .container {
     padding: 16px;
    }
    label {
      position: absolute;

    }
    </style>
  </head>
  <body>
    <form action="admin-insert.php">
     <div class="container">
      <label for="itemName"><b>Item Name</b></label>
      <input type="text" placeholder="Enter Item Name" name="itemName" required><br>
      <label for="Dept"><b>Department</b></label>
      <input type="text" placeholder="Enter Department" name="Dept" required><br>
      <label for="itemSrNo"><b>Item Serial Number</b></label>
      <input type="text" placeholder="Enter Item Sr No." name="itemSrNo" required><br>
      <label for="modelName"><b>Model Name</b></label>
      <input type="text" placeholder="Enter Model Name" name="modelName" required><br>
      <label for="Status"><b>Status</b></label>
      <input type="text" placeholder="Enter Status" name="Status" required><br>
      <label for="dateOfPurchase"><b>Date Of Purchase</b></label>
      <input type="date" placeholder="Enter Date Of Purchase" name="dateOfPurchase" required><br>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter username" name="name" required><br>
      <button type="submit">Submit</button>
    </div>
   </form>
  </body>
</html>
<?php
error_reporting(E_ALL ^ E_NOTICE);
$username = $_GET["name"];
$itemName = $_GET["itemName"];
$Dept = $_GET["Dept"];
$itemSrNo = $_GET["itemSrNo"];
$modelName = $_GET["modelName"];
$Status = $_GET["Status"];
$dateOfPurchase = $_GET["dateOfPurchase"];
$servername= 'localhost';
$fusername = 'root';
$fpassword = '';
$dbname = 'inventoryManagement';
$conn1 = new mysqli($servername, $fusername, $fpassword, $username);
$sql1 = "INSERT INTO $username (itemName , Department , itemSrNo , modelName , Status , dateOfPurchase , Name) VALUES ('$itemName','$Dept','$itemSrNo','$modelName','$Status','$dateOfPurchase','$username')";
if($conn1->query($sql1) === TRUE){
  echo "New record created successfully. "; }
$conn1->close();
 ?>
