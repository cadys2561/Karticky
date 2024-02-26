<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procvičování slovíček</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css?version=<?php echo time(); ?>">

</head>
<body>

<?php
/*
    nav.php
    Navigace pro aplikaci Slovíčkq
    change log:
    2023-12-15 - JCada - v1
    2023-12-16 - Vytvoření stránek na které odkazuji
    2023-12-17 - Bootstrap
               - Implementace do nav.php
    2023-12-18 - Propojení databáze
    2024-01-13 - nové php soubory v service
               - zdárně fungující login
           -14 - zobrazují se jen sety přihlášeného
               - formulář na vytvoření set
               - odhlášení
               - fungující button na vytvoření setu
*/


//zahrneme def.konstanty
//require "../const.php";


?>

<nav class="navbar navbar-expand-lg navbar-light bg-custom"> <!-- Přidána třída bg-custom -->
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Domů</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="sety.php">Sety</a>
        </li>
        <li class="nav-item dropdown">
        <?php

            if(isset($_SESSION["logged_in"]) 
               && $_SESSION["logged_in"])
                 {
                  //echo $_SESSION["email"];
                  echo "<a class='nav-link dropdown-toggle' href='profil.php' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                  ".$_SESSION["email"]."
                </a>
                <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <li><a class='dropdown-item' href='profil.php'>Profil</a></li>
                  <li><a class='dropdown-item' href='log-out.php'>Odhlaš se</a></li>
                </ul>";
            }else{
                  // jinak odkaz na registraci
                    echo " <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    Přihlaš se/ Zaregistruj se
                  </a>
                  <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                    <li><a class='dropdown-item' href='login.php'>Přihlaš se</a></li>
                    <li><a class='dropdown-item' href='reg.php'>Registruj se</a></li>
                  </ul>";
                  }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>



<!--<span class="menuItem">
    <a href="index.php">Domů</a>
</span>     

<span class="menuItem">
    <a href="sety.php">Sety</a>
</span>       

<span class="menuItem">
     <?php/*

    if(isset($_SESSION["logged_in"]) 
        && $_SESSION["logged_in"])
    {
        echo $_SESSION["email"];
        echo "<a href='profil.php'></a>";
    }else{
        // jinak odkaz na registraci
        echo "<a href='login.php'>Přihlášení/Registrace</a>";
    }
    */
    ?>
    
</span>   
-->
</body>
</html>