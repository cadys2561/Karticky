<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <link rel="stylesheet" type="text/css" href="css/style.css?version=<?php echo time(); ?>">
    <title>Profil</title>
</head>
<body class="login">
    

<?php
require "const.php";
require_once "service/connect_db.php";
require_once "service/session.php";

require_once "service/utils.php";




if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  if ($con) {
      $sql = "select id from uzivatele
              where email = '".$_SESSION["email"]."'";
      $sqlstat = mysqli_query($con, $sql);
      if ($row = mysqli_fetch_assoc($sqlstat)) {
          // v $row je zaznam uzivatele
          if ($_POST['heslo1'] == $_POST["heslo2"]) {
              $_SESSION["logged_in"] = true;
              $_SESSION["email"] = $_POST["email"];


              /*$update = "UPDATE uzivatele
                        SET email = '" . $_POST['email'] . "', heslo = '" . $_POST['heslo1'] . "', jmeno = '" . $_POST['jmeno'] . "', prijmeni = '" . $_POST['prijmeni'] . "', telefon = '" . $_POST['telefon'] . "'
                        WHERE id = " . $row['id'];
*/

// Sestavení SQL dotazu na základě odeslaných dat
$update = "UPDATE uzivatele SET ";
if(isset($_POST['email'])) {
    $update .= "email = '" . $_POST['email'] . "', ";
}
if(isset($_POST['heslo1'])) {
    $update .= "heslo = '" . $_POST['heslo1'] . "', ";
}
if(isset($_POST['jmeno'])) {
    $update .= "jmeno = '" . $_POST['jmeno'] . "', ";
}
if(isset($_POST['prijmeni'])) {
    $update .= "prijmeni = '" . $_POST['prijmeni'] . "', ";
}
if(isset($_POST['telefon'])) {
    $update .= "telefon = '" . $_POST['telefon'] . "', ";
}
$update = rtrim($update, ', '); // Odstranění poslední čárky a mezery
$update .= " WHERE id = " . $row['id'];

// Spuštění SQL dotazu na databázi
$result = mysqli_query($con, $update);
if($result) {
  show_ok("Profil byl úspěšně aktualizován.");
} else {
  show_error( "Chyba při aktualizaci profilu: " . mysqli_error($con));
}

          } else { // heslo nesedi
              $_SESSION["logged_in"] = false;
              show_error("Hesla se neshodují");
          }
      } else { // zaznam pro email v DB neex.
          $_SESSION["logged_in"] = false;
          show_error("Chybný email");
      }

  }
}

require "nav/nav.php";
?>

<div class="container">
      <div class="wrapper">
        <div class="title"><span>Tvůj Účet</span></div>
        <form method='POST'>
        <div class="row">

            <i class="fas fa-user"></i>
            <input id='jmeno' type='jmeno' name='jmeno' placeholder='<?php 
            
            $jm = mysqli_query($con, "SELECT jmeno, prijmeni FROM uzivatele WHERE email = '" . $_SESSION["email"] . "'");
            $row = mysqli_fetch_assoc($jm);
            if($row["jmeno"]== null){
              echo "Zadej své jméno";
            } else{
              echo $row["jmeno"];
            }

            ?>' >
          </div>

          <div class="row">
            <i class="fas fa-user"></i>
            <input id='prijmeni' type='prijmeni' name='prijmeni' placeholder='<?php 
            
            $prij = mysqli_query($con, "SELECT jmeno, prijmeni FROM uzivatele WHERE email = '" . $_SESSION["email"] . "'");
            $row = mysqli_fetch_assoc($prij);
            if($row["prijmeni"]== null){
              echo "Zadej své příjmení";
            } else{
              echo $row["prijmeni"];
            }

            ?>' >
          </div>

          <div class="row">
            <i class="fas fa-user"></i>
            <input id='email' type='email' name='email' placeholder='<?php echo $_SESSION["email"];?>' required>
          </div>

          <div class="row">
            <i class="fas fa-user"></i>
            <input id='telefon' type='number' name='telefon' min='100000000' max='999999999' placeholder='<?php 
            
            $tel = mysqli_query($con, "SELECT telefon FROM uzivatele WHERE email = '" . $_SESSION["email"] . "'");
            $row = mysqli_fetch_assoc($tel);
            echo $row["telefon"];
            ?>' required >
          </div>

          <div class="row">
            <i class="fas fa-lock"></i>
            <input id='heslo1' type='password' name='heslo1' placeholder="Změň si heslo" >
          </div>

          <div class="row">
            <i class="fas fa-lock"></i>
            <input id='heslo2' type='password' name='heslo2' placeholder="Zopakuj ho" >
          </div>
     
          <div class="row button">
            <input type="submit" value="Změň infomace o svém účtě">
          </div>
        </form>
      </div>
    </div>


</body>
</html>