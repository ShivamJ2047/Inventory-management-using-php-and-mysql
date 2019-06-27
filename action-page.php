
<?php
error_reporting(E_ALL ^ E_NOTICE);
$username = $_GET["uname"];
$password = $_GET["psw"];
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
      if($row['username']== $username&&$row['password']== $password){
        $flag = '1';
        echo "Logging in...";
        break;
      }
      }
  }
  if($flag=='1'){
      echo "<!DOCTYPE html>
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
       </style>
      </head>
      <body>
       <table>
       <tr>
        <th>Id</th>
        <th>Items</th>
        <th></th>
       </tr>
       </table>
       </body>
       </html>";
      $conn = mysqli_connect("localhost", "root", "",$username);
      // Check connection
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT id, username FROM $username";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["id"]. "</td><td>" . $row["Items"] . "</td><td>";
      }
      echo "</table>";
      } else { echo "Database is empty"; }
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
