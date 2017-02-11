<?php

require 'dbconnection.php';

$brano = $_POST['brano'];

$sql = "SELECT Titolo, Autore FROM Brani WHERE Titolo LIKE '$brano%';";

$ris = $conn->query($sql);

$return = array();

if ($ris->num_rows > 0) {

    while ($row = $ris->fetch_array()) {
        $return['prova'][] = array(
            'Titolo' => $row['Titolo'],
            'Autore' => $row['Autore'],
        );
    }
    echo json_encode($return);
} else {
    echo json_encode("Nessun brano");
}
?>
