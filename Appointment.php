<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>
<style>
  .inner_div {
    max-width: 450px;
  }

  .form {
    display: flex;
    flex-direction: column;
    gap: 10px;

    padding: 20px;
    border-radius: 20px;
    position: relative;
    background-color: white;
    color: black;
    border: 1px solid #333;
  }

  .title {
    font-size: 28px;
    font-weight: 600;
    letter-spacing: -1px;
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 30px;
    color: black;
  }

  .title::before {
    width: 18px;
    height: 18px;
  }

  .title::after {
    width: 18px;
    height: 18px;
    animation: pulse 1s linear infinite;
  }

  .title::before,
  .title::after {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    border-radius: 50%;
    left: 0px;
    background-color: #00d084;
  }

  .message,
  .signin {
    font-size: 14.5px;
    color: black;
  }

  .signin {
    text-align: center;
  }

  .signin a:hover {
    text-decoration: underline royalblue;
  }

  .signin a {
    color: #00bfff;
  }

  .flex {
    display: flex;
    width: 100%;
    gap: 6px;
  }

  .form label {
    position: relative;
  }

  .form label .input {
    background-color: white;
    color: black;
    width: 100%;
    padding: 20px 05px 05px 10px;
    outline: 0;
    border: 1px solid rgba(105, 105, 105, 0.397);
    border-radius: 10px;
  }

  .form label .input+span {
    color: black;
    position: absolute;
    left: 10px;
    top: 0px;
    font-size: 0.9em;
    cursor: text;
    transition: 0.3s ease;
  }

  .form label .input:placeholder-shown+span {
    top: 12.5px;
    font-size: 0.9em;
  }

  .form label .input:focus+span,
  .form label .input:valid+span {
    color: black;
    top: 0px;
    font-size: 0.7em;
    font-weight: 600;
  }

  .input {
    font-size: medium;
  }

  .submit {
    border: none;
    outline: none;
    padding: 10px;
    border-radius: 10px;
    color: #fff;
    font-size: 16px;
    transform: .3s ease;
    background-color: #213360;
  }

  .submit:hover {
    background-color: #61CE70;
  }
  .nnn{
    background-color:#213360;
  }
  .nnn:hover {
    background-color: #61CE70;
  }

  @keyframes pulse {
    from {
      transform: scale(0.9);
      opacity: 1;
    }

    to {
      transform: scale(1.8);
      opacity: 0;
    }
  }
</style>

<body>
  <br><br>
  <div class="container d-flex">
             
    <div class="form">
      <div class="inner_div">
        <p class="title">Book An Appointment</p>
        <p class="message">Please feel welcome to contact our friendly reception staff with any general or medical enquiry. Our doctors will receive or return any urgent calls.</p>
        <div class="flex">
          <label>
            <form action="" method="get">
              <?php
               global $wpdb;
               global $table_prefix;
               $table = $table_prefix . "clinic";
               $qry = "SELECT Clinic FROM $table";
               $result = $wpdb->get_results($qry);
               if(!(count($result)==0)){
              if (!isset($_GET['Appointment'])) {
              global $wpdb;
              global $table_prefix;
              $table = $table_prefix . "clinic";
              $qry = "SELECT Clinic FROM $table";
              $result = $wpdb->get_results($qry);
              $table2 = <<<Tab
        <h6>Select Clinic</h6>
        Tab;
              foreach ($result as $list) {
                $r = "<input name='clinic' required style='padding:5px' class='nnn btn btn-primary m-1' type='submit' value='$list->Clinic'>";
                $table2 .= $r;
                // echo $table2;
              }
              // $table2.= "</select>";
              echo $table2;
            }}
            else{
              echo "<div class='container d-flex justify-content-center'>NOT AVAILABLE</div>";
            }
              ?>
            </form>

          </label>

          <form action="" method="get">
            <label>
              <?php
              if (isset($_GET['clinic'])) {

                global $wpdb;
                global $table_prefix;
                $table = $table_prefix . "Doctors";
                $cli = $_GET['clinic'];
                $qry = "SELECT Doctors FROM $table WHERE Clinic='$cli';";
                $result = $wpdb->get_results($qry);
                echo "<input name='cli' hidden type='text' value='$cli'>";
                $table2 = <<<Tab
        <h6>Select Doctor:</h6>
        <select class="input" style="border-radius: 15px; padding: 5px;" class="m-2" name="Doctor" id="place" required><option disabled>Select Doctor</option>
        Tab;
                foreach ($result as $list) {
                  $r = "<option value='$list->Doctors'>$list->Doctors</option>";
                  $table2 .= $r;
                }
                $table2 .= "</select>";
                echo $table2;

                $st = <<<Tab
    </label>
    </div>  
    <div class="flex">
    <label>
    <input name="nm" class="input" type="text" placeholder="" required="">
    <span>Name</span>
    </label>
    
    <label>
    <input name="em" class="input" type="email" placeholder="" required="">
    <span>Email</span>
    </label>
    </div> 
    
    <div class="flex">
    <label>
    <input name="ph" class="input" type="number" placeholder="" required="">
    <span>Phone</span>
    </label> 
    
    <label>
    <input id="dd" name="dt" class="input" type="date" placeholder="" required="">
    <span>Select Date</span>
    </label>
    <label>
    <input name="tm" class="input" type="time" placeholder="" required="">
    <span>Select Time</span>
    </label>
    </div>
    <div class="d-flex justify-content-center">
    <button name="Appointment" style="min-width: 100%;" class="submit">Make Appointment</button>
    Tab;
    echo $st;
  }
  ?>
          </form>
          <input id="finaldt" hidden value=<?php
          if(isset($_GET['clinic'])){
           global $wpdb;
           global $table_prefix;
           $table=$table_prefix."doctors";
           $sql="SELECT dt FROM $table WHERE Clinic='$cli';";
         $result=$wpdb->get_results($sql);
        //  echo var_dump($result);
        //  echo $result['dt'];
        foreach ($result as $list) {
          echo  $list->dt;
        }}
          ?>>
          </input>


          <?php
          extract($_GET);
          if(isset($Appointment)){
            global $wpdb;
    global $table_prefix;
    $table=$table_prefix."Appointment";
    $sql="INSERT INTO $table (`Clinic`, `Doctor`, `name`, `email`, `phone`, `date`, `time`) VALUES ('$cli', '$Doctor', '$nm', '$em', '$ph', '$dt', '$tm');";
  $wpdb->query($sql);

  if($wpdb){
            echo "Appointment Booked";
          }
        }
          ?>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<script>
    var today=new Date().toISOString().split('T')[0];
    console.log(today);
    document.getElementById("dd").setAttribute("min",today);
    document.getElementById("dd").setAttribute("max",document.getElementById('finaldt').value);
  </script>

</html>