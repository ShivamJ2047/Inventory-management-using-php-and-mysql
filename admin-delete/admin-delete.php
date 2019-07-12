
<?php
error_reporting(E_ALL ^ E_NOTICE);
$username = $_POST['UserName'];
$idnum = $_POST['rownum'];
$servername= 'localhost';
$fusername = 'root';
$fpassword = '';
$dbname = 'inventoryManagement';
$conn = new mysqli($servername, $fusername, $fpassword, $username);
$sql = "DELETE FROM $username WHERE id= $idnum";
if ($conn->query($sql) === TRUE) {
echo "Record deleted successfully";
echo "<script> function redirect(){
                     location.href='http://localhost/test/admin-delete/admin-delete.html';}
               setTimeout(redirect,3000);
      </script>";
  exit;
} else {
echo "Error deleting record: " . $conn->error;
}
$conn->close();
?>
