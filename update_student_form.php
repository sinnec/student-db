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

<h1>Ενημέρωση Σπουδαστή</h1>
 
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql= "SELECT * FROM students WHERE student_am = ".$_GET['am'].";";
$result = mysqli_query($con, $sql);
$row=mysqli_fetch_assoc($result);

echo '<form method="POST">
<label for="am">Αριθμός Μητρώου:</label><br>
<input type="number" id="am" name="am" value='.$row['student_am'].'><br>
<label for="name">Όνομα:</label><br>
<input type="text" id="name" name="name" value='.$row['student_name'].' required><br>
<label for="surname">Επίθετο:</label><br>
<input type="text" id="surname" name="surname" value='.$row['student_lastname'].' required><br>
<label for="age">Ηλικία:</label><br>
<input type="number" id="age" name="age" value='.$row['student_age'].' required><br>
<label for="progress_grade">Βαθμός Προόδου:</label><br>
<input type="number" id="progress_grade" name="progress_grade" value='.$row['student_vathmos_proodos'].'><br>
<label for="exam_grade">Βαθμός Εξετάσεων:</label><br>
<input type="number" id="exam_grade" name="exam_grade" value='.$row['student_vathmos_exetasewn'].'><br>
<br>
<input type="submit" value="Ενημέρωση">
</form>';

$required_fields_assoc = array('name'=>'Όνομα', 'surname'=>'Επίθετο', 'age'=>'Ηλικία');
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
    $student_am = $_POST['am'];
    $student_name = $_POST['name'];
    $student_surname = $_POST['surname'];
    $student_age = $_POST['age'];
    $progress_grade = $_POST['progress_grade'];
    $exam_grade = $_POST['exam_grade'];
    $sql= "UPDATE students SET student_am='$student_am', student_name='$student_name', student_lastname='$student_surname',
          student_age='$student_age', student_vathmos_proodos='$progress_grade', student_vathmos_exetasewn='$exam_grade' WHERE student_am=".$_GET['am'].";";
    if (mysqli_query($con, $sql))
      $_SESSION['message']= '<br><div class="message_ok">Επιτυχής Ενημέρωση Μαθητή!</div>';
    else
      $_SESSION['message']= '<br><div class="message_fail">Μη Επιτυχής Ενημέρωση Μαθητή!</div>';
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
