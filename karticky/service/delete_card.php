<?php
// delete_set.php
require_once "connect_db.php";
require_once "session.php";




if(isset($_SESSION["email"]) 
&& $_SESSION["email"]){
                                    

// Získání dat z požadavku
$_POST = file_get_contents('php://input');

$data = json_decode($_POST, true);

$cardID = $data['cardID'];

//error_log($setID);



$sqldel = mysqli_query($con, "DELETE FROM slovicko WHERE id = $cardID ;");
           if ($sqldel) {
                echo "Slovíčko byl úspěšně smazán.";
            } else {
                echo "Nepodařilo se smazat Slovíčko.";
            }

// Odpověď na požadavek
if ($sqldel) {
    http_response_code(200); // OK
    echo json_encode(array('message' => 'Slovíčko bylo úspěšně smazáno.'));
} else {
    http_response_code(500); // Interní chyba serveru
    echo json_encode(array('message' => 'Nepodařilo se smazat Slovíčko.'));
}


}
?>
