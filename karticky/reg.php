
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
    <title>Registrace</title>
</head>
<body class="login">
    

<?php
require "const.php";
require_once "service/session.php";

require_once "service/connect_db.php";
require_once "service/utils.php";



if (isset($_POST["email"])&&$_POST["heslo1"]==$_POST["heslo2"]) { 



$sql = "insert into uzivatele(email, heslo, jmeno, prijmeni, telefon)\n"
."values('".$_POST["email"]."', '".$_POST["heslo1"]."', '".$_POST["jmeno"]."', '".$_POST["prijmeni"]
."', '".$_POST["telefon"]."')";




if(mysqli_query($con, $sql)) {
  $_SESSION["logged_in"] = true;
  $_SESSION["email"] = $_POST["email"];
  show_ok_back("Nyní jste úspěšně registrován","index.php");
} else {
  show_error("chyba:".mysqli_error($con)) ;
}






exit(); 

}else if($_SERVER["REQUEST_METHOD"] == "POST"){
  show_error("Hesla se neshodují");
}
require "nav/nav.php";
?>

        <div class="container">
      <div class="wrapper">
        <div class="title"><span>Registruj se</span></div>
        <form method='POST'>
        <div class="row">
            <i class="fas fa-user"></i>
            <input id='jmeno' type='jmeno' name='jmeno' placeholder="Jméno" required>
          </div>
          <div class="row">
            <i class="fas fa-user"></i>
            <input id='prijmeni' type='prijmeni' name='prijmeni' placeholder="Příjmení" required>
          </div>
          <div class="row">
            <i class="fas fa-user"></i>
            <input id='email' type='email' name='email' placeholder="Email" required>
          </div>
          <div class="row">
            <i class="fas fa-user"></i>
            <input id='telefon' type='number' name='telefon' min='100000000' max='999999999' placeholder="Telefon" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input id='heslo1' type='password' name='heslo1' placeholder="Heslo" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input id='heslo2' type='password' name='heslo2' placeholder="Zopakuj heslo" required>
          </div>
     
          <div class="row button">
            <input type="submit" value="Registruj se">
          </div>
          <div class="signup-link">Máš už účet? <a href="login.php">Přihlaš se</a></div>
        </form>
      </div>
    </div>




</body>
</html>