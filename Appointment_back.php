<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <title>Sagar Juneja</title>
    </head>
    <body>
    <?php
    $h=<<<Tab
    <div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="btn btn-dark m-1 disabled" href="#">Appointment_Booking</div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

</nav></div>
Tab;
echo $h;

$fo=<<<Tab
<div style="margin: 15px 0px" class="container">
<form action="" method="post">
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Clinic</label>
<input name="cl" required type="text" class="form-control" id="inputEmail4" placeholder="Clinic Name">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Doctor</label>
<input name="dc" required type="text" class="form-control" id="inputPassword4" placeholder="Doctor Name">
</div>
</div>
<div class="form-group">
<label for="inputAddress">Last  Appointment Date</label>
<input name="dt" required type="date" class="form-control" id="inputAddress">
</div>
<button name="Create" type="submit" class="btn btn-primary">Add</button>
</form></div>
Tab;
echo $fo;
if(isset($_POST['Create'])){
  extract($_POST);
    global $wpdb;
    global $table_prefix;
    $table=$table_prefix."doctors";
    $sql="INSERT INTO $table (`Clinic`, `Doctors`, `dt`) VALUES ('$cl', '$dc', '$dt');";
    $wpdb->query($sql);
    global $wpdb;
    global $table_prefix;
    $table2=$table_prefix."clinic";
    $sql="SELECT * FROM $table2 WHERE Clinic='$cl';";
    $result1=$wpdb->get_results($sql);
    if((count($result1)==0)){
      global $wpdb;
      global $table_prefix;
      $table2=$table_prefix."clinic";
      $sql2="INSERT INTO $table2 (`Clinic`) VALUES ('$cl');";
      $wpdb->query($sql2);
    }
    
}
?>

<hr style="border: solid black 1px";>

<h3>ADDED Clinic</h3>
<form action="" method="post">
<?php
global $wpdb;
global $table_prefix;
$table=$table_prefix."doctors";
$sql="SELECT * FROM $table";
$result=$wpdb->get_results($sql);
if(!(count($result)==0)){
$table2 = <<<Tab
<div class="container">
<table class="table table-striped">
<thead>
<tr>
<th scope="col">Clinics</th>
<th scope="col">Doctors</th>
<th scope="col">Last Appointment Date</th>
<th scope="col">Delete</th>
</tr>
</thead>
<tbody>
<tr>
Tab;
foreach ($result as $list) {
  $r = "<td>$list->Clinic</td><td>$list->Doctors</td><td>$list->dt</td><td><button value='$list->Doctors' name='del' class='btn btn-danger'>Delete</button></td>";
  $table2 .= $r;
  $table2 .= "</tr>";
}
$table2 .= "</tbody></table></div>";
echo $table2;
}
else{
  echo "<div class='d-flex justify-content-center'>Empty</div>";
}
?></form>

<?php 
if (isset($_POST['del'])){
  $de=$_POST['del'];
  global $wpdb;
global $table_prefix;
$table=$table_prefix."doctors";
$sql="DELETE FROM $table WHERE Doctors='$de';";
$sql2="SELECT Clinic FROM $table WHERE Doctors='$de';";
$result2=$wpdb->get_results($sql2);
$clin= $result2[0]->Clinic;
// echo $clin;
$result=$wpdb->query($sql);
$sql3="SELECT Clinic FROM $table WHERE Clinic='$clin';";
$result3=$wpdb->get_results($sql3);
if(count($result3)==0){
  global $wpdb;
global $table_prefix;
$table=$table_prefix."clinic";
$sql="DELETE FROM $table WHERE Clinic='$clin';";
$wpdb->query($sql);
}
}

?>

<hr style="border: solid black 1px";>

<h3>Total Appointments</h3>
<?php
global $wpdb;
global $table_prefix;
$table=$table_prefix."appointment";
$sql="SELECT * FROM $table";
$result=$wpdb->get_results($sql);
// echo $result;
if(!(count($result)==0)){
$table2 = <<<Tab
<div class="container">
<table class="table table-striped">
<thead>
<tr>
<th scope="col">Clinics</th>
<th scope="col">Doctors</th>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Phone</th>
<th scope="col">Date</th>
<th scope="col">Time</th>
</tr>
</thead>
<tbody>
<tr>
Tab;
foreach ($result as $list) {
  $r = "<td>$list->Clinic</td><td>$list->Doctor</td><td>$list->name</td><td>$list->email</td><td>$list->phone</td><td>$list->date</td><td>".substr($list->time,0,strlen($list->time)-10)."</td>";
  $table2 .= $r;
  $table2 .= "</tr>";
}
$table2 .= "</tbody></table></div>";
echo $table2;
}
else{
  echo "<div class='container d-flex justify-content-center'>Empty</div>";
}
?>




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
  <script>
    var today=new Date().toISOString().split('T')[0];
    console.log(today);
    document.getElementById("inputAddress").setAttribute("min",today);
  </script>
</html>