<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {box-sizing: border-box;}

body {
  background-color: #ffffcc;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}  table {
   border-collapse: collapse;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 25px;
   text-align: left;
     }
  th {
   background-color: #588c7e;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="#view">View page</a>
  <div class="search-container">
    <form action="admin-view.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<div style="padding-left:16px">
  <p>Search for the Item name, Department, Item Serial Number, Or the username of the borrower.</p>
</div>

<?php
error_reporting(E_ALL ^ E_NOTICE);
$search = $_GET["search"];
$servername= 'localhost';
$fusername = 'root';
$fpassword = '';
$dbname = 'inventoryManagement';
$conn = new mysqli($servername, $fusername, $fpassword, $dbname);
$sql = "SELECT username FROM inventory";
$result = $conn->query($sql);
$flag = '0';
if ($result->num_rows > 0) {
// output data of each row
  while($row = $result->fetch_assoc()) {
     if($row['username']==$search){
       if($flag=='0'){
           echo "
            <table>
            <tr>
             <th>Id</th>
             <th>Items</th>
             <th>Department</th>
             <th>ItemNumber</th>
             <th>Model Name </th>
             <th>Status</th>
             <th>dateOfPurchase</th>
             <th>Name</th>
            ";
            $flag = '1';
           $conn1 = mysqli_connect("localhost", "root", "",$row['username']);
           // Check connection
           if ($conn1->connect_error) {
           die("Connection failed: " . $conn1->connect_error);
           }
           $sql1 = "SELECT id, itemName, Department,itemSrNo,modelName,Status,dateOfPurchase,Name  FROM $row[username]";
           $result1 = $conn1->query($sql1);
           if ($result1->num_rows > 0) {
           // output data of each row
           while($row1 = $result1->fetch_assoc()) {
           echo "<tr><td>" . $row1["id"] . "</td><td>" . $row1["itemName"] . "</td><td>".$row1["Department"] . "</td><td>" . $row1["itemSrNo"] . "</td><td>" . $row1["modelName"]  . "</td><td>" . $row1["Status"]  . "</td><td>" . $row1["dateOfPurchase"]  . "</td><td>" . $row1["Name"] . "</td></tr>";
           }
           echo "</table>";
           } else { echo "Database is empty"; }
         }
     }
     $conn1 = new mysqli($servername, $fusername, $fpassword, $row['username']);
     $sql1 = "SELECT id,itemName , Department , itemSrNo , modelName , Status , dateOfPurchase , Name FROM $row[username]";
     $result1 = $conn1->query($sql1);
     if ($result1->num_rows > 0) {
     // output data of each row
     while($row1 = $result1->fetch_assoc()) {
     if($row1['itemName']==$search || $row1['Department']==$search || $row1['itemSrNo']==$search || $row1['modelName']==$search || $row1['Status']==$search || $row1['dateOfPurchase']==$search || $row1['username']==$search){
      if ($flag == "0"){
        echo "<table>
        <tr>
         <th>Id</th>
         <th>Items</th>
         <th>Department</th>
         <th>ItemNumber</th>
         <th>Model Name </th>
         <th>Status</th>
         <th>dateOfPurchase</th>
         <th>Name</th>";
      }
      echo "
       <tr><td>" . $row1["id"] . "</td><td>" . $row1["itemName"] . "</td><td>".$row1["Department"] . "</td><td>" . $row1["itemSrNo"] . "</td><td>" . $row1["modelName"]  . "</td><td>" . $row1["Status"]  . "</td><td>" . $row1["dateOfPurchase"]  . "</td><td>" . $row1["Name"] . "</td></tr>";
      $flag = "1";
     }
    }
   }
 }
}
?>
</table>
</body>
</html>
