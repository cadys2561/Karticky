<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Procvičuj slovíčka</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css?version=<?php echo time(); ?>">
</head>
<body class="xd1">
    
<?php
require "const.php";
require_once "service/session.php";
require "nav/nav.php";

?>

<div class="bg-box">
<h1 class="main">Vytvořte si vlastní set kartiček k opakování nejen slovíček</h1>

Chceš se naučit nová slovíčka nebo termíny rychle a jednoduše? To jsi tu správně. Tato aplikace ti umožní si vytořit pohodlně kartičky a potom je procvičovat kdekoliv budeš chtít.
    Stačí si je už jen vytvořit. Tak pojďme na to!
</div>
<div style="text-align: center;">
<span class="menuItem" >
    <?php
    if(isset($_SESSION["logged_in"]) 
        && $_SESSION["logged_in"])
    {
        echo "<a href='sety.php'><button type='button' class='btn btn-outline-success'>Vytvoř si svůj set</button></a>";
    }else{
        // jinak odkaz na registraci
        echo "<a href='login.php'><button type='button' class='btn btn-outline-success'>Přihlaš se a začni tvořit</button></a>";
    }
    ?>
    
</span>   
</div>




<div>
<!--Nejoblíbenější sety:-->
<script>
    </script>


</div>

<div>
<!--Náhodně doporučené sety:-->
<script>
    </script>
</div>

</body>
</html>