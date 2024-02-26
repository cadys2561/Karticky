<?php

/**
 * Zobrazi chybove hlaseni.
 */
function show_error($msg)
{
    echo "<script> swal('Něco se nepovedlo', '".$msg."', 'warning'); </script>";
}

function show_ok_back($msg)
{
    echo "<script> swal('Provedeno!', '".$msg."', 'success').then((value) => {
        window.location.href = 'index.php';
      }); 
    
    </script>";
    //echo "<div class='ok'> $msg</div>";
/* echo "<script>";
echo "var message = '" . $msg . "';";
echo "alert(message);";
echo "</script>";*/
}

function show_ok($msg)
{
    echo "<script> swal('Provedeno!', '".$msg."', 'success');</script>";
    //echo "<div class='ok'> $msg</div>";
/* echo "<script>";
echo "var message = '" . $msg . "';";
echo "alert(message);";
echo "</script>";*/
}




?>


