<?php
$username = $_GET["uname"];
$password = $_GET["psw"];
if(strpos($username," ")!= FALSE||strpos($password," ") != FALSE){
  echo "Spaces are not allowed";
}
else{
    $servername= 'localhost';
    $fusername = 'root';
    $fpassword = '';
    $dbname = 'inventoryManagement';
    //$mysqli = new mysqli("localhost", "username", "password", "dbname");
     $conn = new mysqli($servername, $fusername, $fpassword, $dbname);
      echo "Connection successful! " . "<bc>";
      $sql = "SELECT username FROM inventory";
      $result = $conn->query($sql);
      $flag = '0';
      if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
           if($row['username']== $username){
             $flag = '1';
             echo "User already exists.";
             break;
           }
           }
       }
       if($flag=='0'){
       $sql = "INSERT INTO inventory (username, password) VALUES ('$username', '$password')";
       if($conn->query($sql) === TRUE){
         echo "New record created successfully. "; }
          else {
            echo "<bc> Error: " . $sql . "<br>" . $conn->error;
          }
        echo "Creating a new Database... ";
        $conn1 = new mysqli($servername, $fusername, $fpassword);
         // Check connection
           if ($conn1->connect_error) {
            die("Connection failed: " . $conn1->connect_error);
              }

        // Create database
        $sql1 = "CREATE DATABASE $username";
        if ($conn1->query($sql1) === TRUE) {
        echo "Database created successfully!";
        } else {
        echo "Error creating database: " . $conn1->error;
        }
        $conn2 = new mysqli($servername, $fusername, $fpassword,$username);
        $sql2 = "CREATE TABLE $username (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        itemName VARCHAR(30) NOT NULL,
        Department VARCHAR(30) NOT NULL,
        itemSrNo VARCHAR(30) NOT NULL,
        modelName VARCHAR(30) NOT NULL,
        Status VARCHAR(30) NOT NULL,
        dateOfPurchase VARCHAR(30) NOT NULL,
        Name VARCHAR(30) NOT NULL
        )";
        if ($conn2->query($sql2) === TRUE) {
        echo "Table created successfully";
        } else {
        echo "Error creating table: " . $conn2->error;
        }

        $conn2->close();
        $conn1->close();
      } $conn->close();
    }
  ?>
