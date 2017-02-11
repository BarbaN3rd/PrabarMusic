<?php
session_start();

require 'dbconnection.php';


$nome = $_POST['nome'];
$cognome = $_POST['cognome'];

$nUtente = $_SESSION['prabarmusic']['NomeUtente'];


$sql = "UPDATE Utente SET Nome = '$nome', Cognome = '$cognome' WHERE NomeUtente = '$nUtente';";
echo $sql;
$ris = $conn->query($sql);

if($ris) { //aggiorno i dati altrimenti non vengono aggiornati fino alla nuova sessione
    $_SESSION['prabarmusic']['Cognome'] = $cognome;
    $_SESSION['prabarmusic']['Nome'] = $nome;
}

header('location: profile.php');

?>