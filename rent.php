<?php

session_start();

require 'dbconnection.php';

$idbrano = $_POST['brano'];
$nUtente = $_SESSION['prabarmusic']['NomeUtente'];

$data = date('Y-m-d');


$sql = "INSERT INTO Prestiti VALUES ('$idbrano', '$nUtente', '$data');";
$conn->query($sql);
$sql = "UPDATE Brani SET Disponibilita = 1 WHERE IDBrano = $idbrano;";
$conn->query($sql);


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
