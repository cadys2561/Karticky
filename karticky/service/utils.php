<?php

/**
 * Zobrazi chybove hlaseni.
 */
function show_error($msg)
{
    echo "<script> swal('Něco se nepovedlo', '".$msg."', 'warning'); </script>";
}

function show_ok_back($msg,$link)
{
    echo "<script> swal('Provedeno!', '".$msg."', 'success').then((value) => {
        window.location.href = '$link';
      }); 
    
    </script>";
    
}

function show_ok($msg)
{
    echo "<script> swal('Provedeno!', '".$msg."', 'success');</script>";
    
}

/*function show_ok_set($msg)
{
    echo "<script> swal('Provedeno!', '".$msg."', 'success').then((value) => {
        window.location.href = 'sety.php';
      }); 
    
    </script>";

}
*/

?>


