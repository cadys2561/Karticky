<?php
// delete_set.php
require_once "connect_db.php";
require_once "session.php";


/*


V Práci nepoužito, jenom nápad do budoucna






*/

if(isset($_SESSION["email"]) 
&& $_SESSION["email"]){
                                    

// Získání dat z požadavku
$_POST = file_get_contents('php://input');

$data = json_decode($_POST, true);

$setID = $data['setID'];

//error_log($setID);



$sqlQuery = "SELECT slovicko, definice FROM slovicko WHERE sety_id = $setID ORDER BY RAND() LIMIT 10";
$result = mysqli_query($con, $sqlQuery);

// Vytvoření pole se slovíčky
$words = array();
while($row = mysqli_fetch_assoc($result)) {
    $words[$row['slovicko']] = $row['definice'];
}
error_log($words);
// Odpověď na požadavek
if ($words) {
    http_response_code(200); // OK
    echo json_encode($words);
} else {
    http_response_code(500); // Interní chyba serveru
    echo json_encode(array('message' => 'Nepodařilo se získat slovíčka.'));
}
}
?>