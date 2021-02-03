<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid black;
  text-align: center;
  padding: 8px;
}
</style>
</head>
<body>

<h1>Διαγραφή Σπουδαστή</h1>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql= "SELECT * FROM students;";
$result = mysqli_query($con, $sql);

echo "<table>
<tr>
  <th>ΑΜ</th>
  <th>ΟΝΟΜΑ</th>
  <th>ΕΠΙΘΕΤΟ</th>
  <th>ΗΛΙΚΙΑ</th>
  <th>ΒΑΘΜΟΣ ΠΡΟΟΔΟΥ</th>
  <th>ΒΑΘΜΟΣ ΕΞΕΤΑΣΕΩΝ</th>
</tr>";

$row=mysqli_fetch_assoc($result);
foreach ($result as $row) {
  $am = $row['student_am'];
  echo "<tr>
  <td><a href='delete_student_proccess.php?am=".$row['student_am']."'>".$row['student_am']."</a></td>
  <td>".$row['student_name']."</td>
  <td>".$row['student_lastname']."</td>
  <td>".$row['student_age']."</td>
  <td>".$row['student_vathmos_proodos']."</td>
  <td>".$row['student_vathmos_exetasewn']."</td>
  </tr>";
}
echo "</table>";
mysqli_close($con);

?>
<br>
<form action="home.php">
    <input type="submit" value="Επιστροφή" />
</body>
</html>
