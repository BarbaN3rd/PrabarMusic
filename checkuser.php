<?php

require 'dbconnection.php';
$nick = $_POST['nickname'];
$sql = "SELECT NomeUtente FROM Utente WHERE NomeUtente = '$nick';";
$risultato = $conn->query($sql);
$numero = $risultato->num_rows;
echo $numero;



?>

