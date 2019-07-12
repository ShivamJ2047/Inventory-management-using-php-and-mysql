<html>
<head>
 <title>Table with database</title>
 <style>
  table {
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
  button {
   background-color: #4CAF50;
   color: white;
   padding: 14px 20px;
   margin: 8px 0;
   border: none;
   cursor: pointer;
   width: 10%;
  }
  body {
    background-color:#ffffcc;
  }

 </style>
</head>
<body>
</body>
</html>

  <?php
error_reporting(E_ALL ^ E_NOTICE);
$username = $_POST["uname"];
$password = $_POST["psw"];
$servername= 'localhost';
$fusername = 'root';
$fpassword = '';
$dbname = 'inventoryManagement';
 $conn = new mysqli($servername, $fusername, $fpassword, $dbname);
 echo "Connection successful! " . "<bc>";
 $sql = "SELECT username,password FROM inventory";
 $result = $conn->query($sql);
 $flag = '0';
 if ($result->num_rows > 0) {
 // output data of each row
   while($row = $result->fetch_assoc()) {
      if($username=='admin'&&$row['password']==$password){
        $flag = '2';
        echo "Logging in...";
        break;
      }
      elseif($row['username']== $username&&$row['password']== $password){
        $flag = '1';
        echo "Logging in...";
        break;
      }
      }
  }
  if($flag=='1'){
    echo "logged in!";
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
      $conn = mysqli_connect("localhost", "root", "",$username);
      // Check connection
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT id, itemName, Department,itemSrNo,modelName,Status,dateOfPurchase,Name  FROM $username";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["id"] . "</td><td>" . $row["itemName"] . "</td><td>".$row["Department"] . "</td><td>" . $row["itemSrNo"] . "</td><td>" . $row["modelName"]  . "</td><td>" . $row["Status"]  . "</td><td>" . $row["dateOfPurchase"]  . "</td><td>" . $row["Name"] . "</td></tr>";
      }
      echo "</table>";
      } else { echo "Database is empty"; }
    }
    elseif ($flag == '2') {
      // code...
      echo "Logged in!";
      echo "
      <form action = 'admin-view/admin-view.php'>
      <button>View</button>
      </form>
      <form action = 'admin-insert/admin-insert.php'>
      <button>Insert</button>
      </form>
      <form action = 'admin-delete/admin-delete.html'>
      <button>Delete</button>
      </form>
      ";
    }
    elseif($flag == '0'){
      echo "Username and password didn't match.Try again! ";
      echo "<script> function redirect(){
                           location.href='http://localhost/test/';}
                     setTimeout(redirect,3000);
            </script>";
        exit;
    }
      $conn->close();
?>
</body>
</html>
