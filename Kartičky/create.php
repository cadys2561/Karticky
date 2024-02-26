<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css?version=<?php echo time(); ?>">
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body class="xd1">
<?php
require "const.php";
require_once "service/connect_db.php";
require_once "service/session.php";
require "nav/nav.php";


require_once "service/utils.php";


if (isset($_POST["nazev"])){

$id=mysqli_query($con,"select id from uzivatele where email ='".$_SESSION["email"]."'");
$row = mysqli_fetch_assoc($id);
$sql = "insert into sety(nazev, jazyk, pozn,  uzivatele_id)\n" //sdilene,
."values('".$_POST["nazev"]."', '".$_POST["jazyk"]."','".$_POST["pozn"]."' , '".$row["id"]."')"; //, '".$_POST["yes_no"]."' 
//."values('".$_POST["nazev"]."', '".$_POST["jayzk"]."', '".$_POST["pozn"]."')"; //TODo - přidat yes or no sdílení a dodělat automatické provázání na uživ.


if(mysqli_query($con, $sql)) {
    show_ok("Set byl vytvořen!");
    } else {
    echo "chyba:".mysqli_error($con).BR;
    }
    
}
?>    




        
        <div class="container">
      <div class="wrapper">
        <div class="title"><span>Vytvoř si set</span></div>
        <form method='POST'>
          <div class="row">
            <i class="fas fa-user"></i>
            <input id='nazev' type='nazev' name='nazev' placeholder="Název" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input id='jazyk' type='jazyk' name='jazyk' placeholder="Jazyk" required>
          </div>
          <div class="row">
            <i class="fas fa-user"></i>
            <input id='pozn' type='pozn' name='pozn' placeholder="Poznámka">
          </div>
          <div class="row button">
            <input type="submit" value="Vytvoř">
          </div>
        </form>
      </div>
    </div>


</body>
</html>