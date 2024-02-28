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
<body class="set">

<script>


    
function deleteCard(cardID) {
    console.log("test" + cardID);
    if (confirm("Opravdu chcete smazat tuto kartičku?")) {
        // Potvrzení smazání pomocí AJAX
        console.log("test");
        fetch('service/delete_card.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cardID: cardID })
        })
        .then(response => {
            if (!response.ok) {
                console.log("test 1");
                throw new Error('Nepodařilo se smazat kartičku.');
            }
            // Znovunačtení stránky po úspěšném smazání
            location.reload();
        })
        .catch(error => {
            console.log("test 2");
            console.error('Chyba při mazání Slovíčka:', error);
        });
    }
}

</script>

<?php
require_once "service/session.php";
require "const.php";
require "nav/nav.php";
require_once "service/connect_db.php";

require_once "service/utils.php";


$setID = isset($_GET['set_id']) ? $_GET['set_id'] : null;

if (isset($_POST["slovicko"])){
    $id = mysqli_query($con, "select id from uzivatele where email = '" . $_SESSION["email"] . "'");
    $row = mysqli_fetch_assoc($id);

    $sql = "insert into slovicko (slovicko, definice,sety_id, sety_uzivatele_id)\n"
            ."values('".$_POST["slovicko"]."' , '".$_POST["definice"]."' , '".$setID."' , '".$row["id"]."')";
    if(mysqli_query($con, $sql)) {
        show_ok("Slovíčko úspěšně vloženo");
            } else {
        show_error("chyba:".mysqli_error($con)).BR;
    }
}


$sql = "SELECT nazev, jazyk FROM sety WHERE id = $setID";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
echo "<div class='bg-box-sm'>
<h1 class='main-sm'>".$row['nazev']."</h1>
Jazyk: ".$row['jazyk']."

</div>";



if ($setID !== null) {
    $sql = "SELECT id, slovicko, definice FROM slovicko WHERE sety_id = $setID"; 
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<div class='flip-card-container'>";
        while ($row = mysqli_fetch_assoc($result)){

        echo "
<div class='card-item'>
    <div class='checkbox' style='position: relative; top: 0; left: 10px;'>
        <input type='checkbox' id='checkbox1'>
        <label for='checkbox1'>Pamatuji si</label>
    </div>
    
    <button type='button' class='btn btn-danger' style='position: absolute; top: 0; right: 0px; width: 20px; height: 25px; border-radius: 10px;' onclick='deleteCard(".$row['id'].")'>
    <svg xmlns='http://www.w3.org/2000/svg' width='8' height='8' fill='currentColor' class='bi bi-trash' style='position: absolute; top: 5; right: 0px; width: 20px; height: 25px; viewBox='0 0 16 16'>
        <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
        <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
    </svg>
    </button>

  <div class='flip-card'>
    <div id='".$row['id']."' class='flip-card-inner'>
      <div class='flip-card-front'>
        <h1>".$row['slovicko']."</h1>
      </div>
      <div class='flip-card-back'>
        <h1>".$row['definice']."</h1>
      </div>
    </div>
  </div>
</div>
      ";        
        }
        echo"</div>";
    } else {
        echo "Error retrieving data from the database: " . mysqli_error($con);
    }

    
   
} 


/*
//Nápad na zlepšení? - Udělat funkci, která ti vybere jenom náhodný počet kartiček a ten se ti pak zobrazí

$sqlQuery = "SELECT slovicko, definice FROM slovicko WHERE sety_id = $setID ORDER BY RAND() LIMIT 10";
$result = mysqli_query($con, $sqlQuery);

// Vytvoření pole se slovíčky
$words = array();
while($row = mysqli_fetch_assoc($result)) {
    $words[$row['slovicko']] = $row['definice'];
}

print_r($words);

*/

?>
<button type='button' class="btn btn-success" id="swapAllButton">Chceš začít s definicí?</button>

<script>
    document.getElementById('swapAllButton').addEventListener('click', function() {
        var cards = document.querySelectorAll('.flip-card-inner');
        cards.forEach(function(card) {
            var front = card.querySelector('.flip-card-front h1').innerText;
            var back = card.querySelector('.flip-card-back h1').innerText;
            card.querySelector('.flip-card-front h1').innerText = back;
            card.querySelector('.flip-card-back h1').innerText = front;
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.flip-card .flip-card-front').click(function() {
                $(this).closest('.flip-card').toggleClass('hover');
            });
        });

        $(document).ready(function(){
            $('.flip-card .flip-card-back').click(function() {
                $(this).closest('.flip-card').toggleClass('hover');
            });
        });

        
    </script>




        <div class="container">
      <div class="wrapper">
        <div class="title"><span>Přidej slovíčko</span></div>
        <form method='POST'>
          <div class="row">
            <i class="fas fa-user"></i>
            <input id='slovicko' type='slovicko' name='slovicko' placeholder="Slovíčko:" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input id='definice' type='definice' name='definice' placeholder="Definice:" required>
          </div>
          <div class="row button">
            <input type="submit" value="Přidej" >
          </div>
        </form>
      </div>
    </div>
       
        



 



<script>

/*

function show_cards() {
        let setID = <?php /*
            $setID = isset($_GET['set_id']) ? $_GET['set_id'] : null;
            echo $setID;*/?>;
        console.log(setID);
        fetch('service/get_slovicka.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ setID: setID })
        })
        .then(response => {
            
            if (!response.ok) {
                console.log("test 1");
                throw new Error('Nepodařilo se získat slovíčka');
            }
            return response.json();
        })
        .catch(error => {
            console.log("test 2");
            console.error('Chyba při získávání slovíček:', error);
        });
    
}




show_cards();


*/


</script>
        <?php
/*
$var = 1;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'next':
                $var++;
                echo $var;
                break;

            case 'prev':
                $var = max(1, $var - 1); 
                break;

            case 'flip':
                // Prohození hodnoty slovíčka a definice
                $sqlstat = mysqli_query($con,
                    "SELECT slovicko, definice FROM slovicko
                    WHERE id = '" . $var . "'");
                if ($sqlstat) {
                    $row = mysqli_fetch_assoc($sqlstat);
                    if ($row) {
                        $temp = $row['slovicko'];
                        $row['slovicko'] = $row['definice'];
                        $row['definice'] = $temp;
                    } else {
                        echo "Data nebyla nalezena.";
                    }
                } else {
                    echo "Chyba v dotazu: " . mysqli_error($con);
                }
                break;
        }
    }
} else {
    // Inicializace pro první zobrazení stránky
    $sqlstat = mysqli_query($con,
        "SELECT slovicko, definice FROM slovicko
        WHERE id = '" . $var . "'");
    if ($sqlstat) {
        $row = mysqli_fetch_assoc($sqlstat);
        if (!$row) {
            
            echo "Data nebyla nalezena.";
        }
    } else {
        echo "Chyba v dotazu: " . mysqli_error($con);
    }
}
*/
?>
<!--
<form method="POST" action="">
    <button type="submit" name="action" value="prev">Předchozí</button>
    <button type="submit" name="action" value="next">Další</button>
    <button type="submit" name="action" value="flip">Otoč</button>
</form>
-->



</body>
</html>