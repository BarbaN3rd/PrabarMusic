<?php

session_start();


require 'dbconnection.php';

include("utility.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nickname = mysql_real_escape_string($_POST["nomeutente"]);
$password = mysql_real_escape_string($_POST["password"]);
$risposta = $conn->query("SELECT * FROM Utente WHERE NomeUtente='$nickname' AND Password='$password'");

/*if ($_POST['mantieni'] == 'oks') {
    setcookie("user[username]", $nickname, time() + 3600);
    setcookie("user[password]", $password, time() + 3600);
    //header('location: google.it');
}*/

$utente = $risposta->fetch_assoc();



if (($risposta->num_rows) == 0) { //se utente è un array vuoto
    header('location: login.html');
} else {
    login($utente); //memorizza in sessione i dati dell'utente
    header('location: index.php');
}
?>