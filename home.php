 <?php
session_start();
 ?>
 <!DOCTYPE html>
<html>
<head>
<style>

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

.message_ok {
	text-align: center;
  color: white;
  background: green;
}

.message_fail {
	text-align: center;
  color: white;
  background: red;
}

</style>
</head>
<body>

<ul>
  <li><a href="insert_student.php">Εισαγωγή Σπουδαστή</a></li>
  <li><a href="update_student.php">Ενημέρωση Σπουδαστή</a></li>
  <li><a href="delete_student.php">Διαγραφή Σπουδαστή</a></li>
  <li><a href="show_student.php">Προβολή Σπουδαστών</a></li>
</ul>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";
$con = mysqli_connect($servername, $username, $password);
if (!mysqli_select_db($con, $dbname)) {
  $sql = "CREATE DATABASE $dbname;";
  mysqli_query($con, $sql);
  mysqli_select_db($con, $dbname);
  $sql = "CREATE TABLE students (
    student_am INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(50) NOT NULL,
    student_lastname VARCHAR(50) NOT NULL,
    student_age INTEGER NOT NULL,
    student_vathmos_proodos INTEGER,
    student_vathmos_exetasewn INTEGER
    );";
  mysqli_query($con, $sql);
}
mysqli_close($con);

if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  $_SESSION['message'] = null;
}

?>

</body>
</html>
