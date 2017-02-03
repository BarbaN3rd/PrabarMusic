<?php 

// Funzione che serve per creare la sessione
function login($dati){
    $_SESSION['loggin_prabarmusic']=$dati;
}

// Funzione che serve per la verifica della sessione
function isLogged() {
	return $_SESSION["loggin_prabarmusic"];
}

?>