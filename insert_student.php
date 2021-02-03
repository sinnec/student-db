 <?php
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
<style>
.message_fail {
	text-align: left;
  color: red;
}
</style>
</head>
<body>

<h1>Καταχώρηση Σπουδαστή</h1>

<form method="POST">
  <label for="am">Αριθμός Μητρώου:</label><br>
  <input type="number" id="am" name="am" disabled>
  <span style= "color:red">Αυτόματη συμπλήρωση από το σύστημα</span><br>
  <label for="name">Όνομα:</label><br>
  <input type="text" id="name" name="name"><br>
  <label for="surname">Επίθετο:</label><br>
  <input type="text" id="surname" name="surname"><br>
  <label for="age">Ηλικία:</label><br>
  <input type="number" id="age" name="age" required><br>
  <label for="progress_grade">Βαθμός Προόδου:</label><br>
  <input type="number" id="progress_grade" name="progress_grade"><br>
  <label for="exam_grade">Βαθμός Εξετάσεων:</label><br>
  <input type="number" id="exam_grade" name="exam_grade"><br>
  <br>
  <input type="submit" value="Καταχώρηση">
</form> 
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$required_fields_assoc = array('name'=>'Όνομα', 'surname'=>'Επίσθετο', 'age'=>'Ηλικία');
$error = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  foreach ($required_fields_assoc as $key=>$value) {
    if (empty($_POST[$key])) {
      $_SESSION['message'] .= '<br><div class="message_fail">Το πεδίο: '.$value.' είναι κενό!<br><div>';
      $error = true;
    }
  }
}

if (!$error) {
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = $_POST['name'];
    $student_surname = $_POST['surname'];
    $student_age = $_POST['age'];
    $progress_grade = $_POST['progress_grade'];
    $exam_grade = $_POST['exam_grade'];
    $sql= "INSERT INTO students (student_name, student_lastname, student_age, student_vathmos_proodos, student_vathmos_exetasewn)
          VALUES ('$student_name','$student_surname','$student_age','$progress_grade', '$exam_grade');";
    if (mysqli_query($con, $sql))
      $_SESSION['message']= '<br><div class="message_ok">Επιτυχής Καταχώρηση Μαθητή!</div>';
    else
      $_SESSION['message']= '<br><div class="message_fail">Μη Επιτυχής Καταχώρηση Μαθητή!</div>';
    mysqli_close($con);
    header("Location: home.php");
  }
}
else if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  $_SESSION['message'] = null;
}
?>
<br>
<form action="home.php">
    <input type="submit" value="Επιστροφή" />
</body>
</html>
