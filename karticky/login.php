<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css?version=<?php echo time(); ?>">
    <script src="js/script.js" ></script>
    
    <title>Přihlášení</title>
</head>
<body class="login">
    

<?php

require "const.php";


require_once "service/connect_db.php";
require_once "service/utils.php";
require_once "service/session.php";



if (isset($_POST["email"])) { 
    if ($con) {
        $sql = "select heslo from uzivatele
                where email = '".$_POST["email"]."'";
        $sqlstat = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_assoc($sqlstat)) {
            // v $row je zaznam uzivatele
            if ($_POST['heslo'] == $row["heslo"]) {
                // hesla sedi (co zadal uziv. do form a co je v DB)
                $_SESSION["logged_in"] = true;
                $_SESSION["email"] = $_POST["email"];
                //$_SESSION["id"] = $row["id"]; 
                show_ok_back("Úspěšně přihlášen","index.php");
            } else { // heslo nesedi
                $_SESSION["logged_in"] = false;
                show_error("Chybný email nebo heslo");
            }
        } else { // zaznam pro email v DB neex.
            $_SESSION["logged_in"] = false;
            show_error("Chybný email nebo heslo");
        }

    }
}

require "nav/nav.php";
?>


  <!--  <form method='POST'>  action odesílá na zadaný php skript 
         id -- nutnu mít sekvenci
        
        
        <input type="hidden" name="action" value="submited"/>

        <label for='email'> *Email: </label>
        <input id='email' type='email' name='email' required />
        <br/>
        <label for='heslo'> *Heslo: </label>
        <input id='heslo' type='password' name='heslo' required/>
        <br/>
        <input type='submit' value='Přihlaš se'/>
        </form>
        -->
<script>
function alertFunction(event){
  swal('Na této funkci ještě pracuji...', 'Bohužel :-(', 'warning');
}
</script>
        <div class="container">
      <div class="wrapper">
        <div class="title"><span>Přihlaš se</span></div>
        <form method='POST'>
          <div class="row">
            <i class="fas fa-user"></i>
            <input id='email' type='email' name='email' placeholder="Email" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input id='heslo' type='password' name='heslo' placeholder="Heslo" required>
          </div>
          <div class="pass"><a onclick="alertFunction()">Zapomenuté heslo?</a></div>
          <div class="row button">
            <input type="submit" value="Přihlaš">
          </div>
          <div class="signup-link">Nemáš ještě účet? <a href="reg.php">Založ si ho!</a></div>
        </form>
      </div>
    </div>

        
</body>
</html>