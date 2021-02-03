 <?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql= "DELETE FROM students WHERE student_am=".$_GET['am'].";";
if (mysqli_query($con, $sql))
  $_SESSION['message']= '<br><div class="message_ok">Επιτυχής Διαγραφή Μαθητή!</div>';
else
  $_SESSION['message']= '<br><div class="message_fail">Μη Επιτυχής Διαγραφή Μαθητή!</div>';
mysqli_close($con);
header("Location: home.php");

?>
