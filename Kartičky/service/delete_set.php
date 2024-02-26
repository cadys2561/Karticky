<?php
// delete_set.php
require_once "connect_db.php";
require_once "session.php";




if(isset($_SESSION["email"]) 
&& $_SESSION["email"]){
                                    

// Získání dat z požadavku
$_POST = file_get_contents('php://input');

$data = json_decode($_POST, true);

$setID = $data['setID'];

//error_log($setID);



$sqldel = mysqli_query($con, "DELETE FROM sety WHERE id = $setID ;");
           if ($sqldel) {
                echo "Set byl úspěšně smazán.";
            } else {
                echo "Nepodařilo se smazat set.";
            }

// Odpověď na požadavek
if ($sqldel) {
    http_response_code(200); // OK
    echo json_encode(array('message' => 'Set byl úspěšně smazán.'));
} else {
    http_response_code(500); // Interní chyba serveru
    echo json_encode(array('message' => 'Nepodařilo se smazat set.'));
}


}
?>
