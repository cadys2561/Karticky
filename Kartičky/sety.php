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
    <title>Procvičování slovíček</title>
</head>
<body class="xd1">
    
<?php
require "const.php";
require_once "service/session.php";
//zahrň nav.php navigaci
require "nav/nav.php";
//propojení databáze
require_once "service/connect_db.php";
require_once "service/utils.php";

?>
<script>
    console.log("test" );
function deleteSet(setID) {
    console.log("test" + setID);
    if (confirm("Opravdu chcete smazat tento set?")) {
        // Potvrzení smazání pomocí AJAX
        console.log("test");
        fetch('service/delete_set.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ setID: setID })
        })
        .then(response => {
            if (!response.ok) {
                console.log("test 1");
                throw new Error('Nepodařilo se smazat set.');
            }
            // Znovunačtení stránky po úspěšném smazání
            location.reload();
        })
        .catch(error => {
            console.log("test 2");
            console.error('Chyba při mazání setu:', error);
        });
    }
}

</script>


<div class="bg-box-sm">
<h1 class="main-sm">Seznam setů</h1>
Již vytvořené sety:

</div>
<?php




if(isset($_SESSION["email"]) 
&& $_SESSION["email"]){
    
    
    
    
        if ($con) {
            echo BR;
        }
    
        $id = mysqli_query($con, "SELECT id FROM uzivatele WHERE email = '" . $_SESSION["email"] . "'");
        $row = mysqli_fetch_assoc($id);
    
        $sqlstat = mysqli_query($con, "SELECT id, nazev, jazyk FROM sety WHERE uzivatele_id = '" . $row["id"] . "'");
        //if ($sqlstat) {
        //    echo "SQL prikaz uspesne vykonan" . BR;
        //}
    
        /*
        function get_nazev($setID)
        {
            $_SESSION["sety_id"] = $setID;
        }

        function deleteSet($setID, $con){
            $sqldel = mysqli_query($con, "DELETE FROM sety WHERE id = $setID");
            if ($sqldel) {
                echo "Set byl úspěšně smazán.";
            } else {
                echo "Nepodařilo se smazat set.";
            }
        }
        */

        while ($row = mysqli_fetch_assoc($sqlstat)) {
            $setID = $row["id"];
            
            echo "<div style='position: relative; display: inline-block;'>
            <a href='set.php?set_id=$setID'>
                <button type='button' class='btn btn-outline-success' style='margin-right: 53px; margin-left: 10px;' onclick='get_nazev($setID)'>
                    " . $row["nazev"] . ' - ' . $row["jazyk"] . "
                </button>
            </a>
            <button type='button' class='btn btn-danger' style='position: absolute; top: 0; right: 0; margin-right: 10px;' onclick='deleteSet($setID)'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
                    <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
                </svg>
            </button>
        </div>";
    
        }
    }else{
        echo "přihlaš se";
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*    
    if($con){
        echo"provedeno".BR;
    }

$id=mysqli_query($con,"select id from uzivatele where email ='".$_SESSION["email"]."'");
$row = mysqli_fetch_assoc($id);

$sqlstat = mysqli_query($con,
    "select nazev, jazyk from sety
    where uzivatele_id = '".$row["id"]."'");
if ($sqlstat) {
    echo "SQL prikaz uspesne vykonan".BR;
}

function get_nazev(){$_SESSION["sety_id"]=$row["id"];}

while ($row = mysqli_fetch_assoc($sqlstat)) {
    $setID = $row["id"]; // Assuming 'set_id' is the column name in your database table that uniquely identifies each set.
    echo "<a href='set.php?set_id=$setID'><button type='button' class='btn btn-outline-success' onclick='get_nazev($setID)'>"
        . $row["nazev"] . ' - ' . $row["jazyk"] . "</button></a>" . PHP_EOL;
}   

/*while($row = mysqli_fetch_assoc($sqlstat))
    {
        echo"<a onclick='get_nazev()' href='set.php'><button type='button' class='btn btn-outline-success'>".$row["nazev"].' - '.$row["jazyk"]."</button></a>".BR;//vypíše název setu a jeho jazyk
    }
*/







?>





<a <?php if(isset($_SESSION["email"])&& $_SESSION["email"]){echo"href='create.php'";}else{echo"href='login.php'";}?> >
<div class="bottom" >
    <div class="d-grid gap-2 " >
        <button class="btn btn-primary" type="button" >
            Vytvoř si nový set
        </button>
         <!-- TODO - caller když se přihlašuji odtud, tak že po přihlášeníá mě to hodí zpět sem, respektive na vytvoření setů  -->
    </div>   
</div>
</a>
</body>
</html>

