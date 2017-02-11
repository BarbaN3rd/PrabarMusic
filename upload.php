<?php
session_start();
require 'dbconnection.php';
include('utility.php');
header('Content-Type: text/html; charset=utf-8');

if (!isLogged()) {
    header('location: login.html');
}
?>

<html>
    <head>
        <title>Carica la tua canzone</title>
    </head>
    <body>
        <link rel="stylesheet" href="style_dir/style_global.css">
        <link rel="stylesheet" type="text/css" href="style_dir/style_index.css">
        <style>
            #similarSongs {display: none; box-shadow: 0 0 3px rgba(139, 139, 139, 1); padding: 5px; margin: 10px 0; max-width: 300px; border: 1px solid #fff;}
            table tr:nth-child(odd) {background-color: #e5e5e5;}
            table td {padding: 5px;}
            
            label {display: block;}
            
        </style>
        <script src="jquery/jquery-3.1.1.min.js"></script>
        <script src="jquery/ajax_upload.js"></script>
        <div class="header">
            <div class="nav-wrapper">
                <div class="site-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php">Prabar Music</a></li>
                        <li class="nav-item"><a href="#">Brani</a></li>
                        <?php
                        if (isLogged()) {
                            echo "<li class='nav-item'><a href='profile.php'>Account</a></li>";
                            echo "<li class='nav-item selected'><a class='bold' href='upload.php'>Carica</a></li>";
                            echo "<li class='nav-item'><a href='logout.php'>Logout</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="account-nav">
                    prova
                </div>
            </div>
        </div>
        <div id="container">
            <h1>Carica un nuovo brano</h1>
            <p class="details info">
                Da questa pagina puoi caricare tutte le canzone che desideri, pattoché <span class="bold">non siano coperte da copyright</span>.
            </p>
            <p class="details info">
                Un brano ha una dimensione massima pari a <span class='bold'>32 megabytes</span> mentre la dimensione massima per quanto riguarda la copertina
                dell'album è pari a <span class='bold'>2 megabytes</span>. Se la copertina è già presente nella tua lista copertina, puoi sceglierla attraverso il menù a tendina oppure, più semplicemente,
                puoi anche non indicarla.
            </p>
            <form action="upload.php" method="post">
                <label>Titolo brano</label>
                <input type="text" id="nBrano">
                <div id="similarSongs">
                    <span style="margin-bottom: 7px; display: inline-block; font-size: 13px;" class="details info">
                        Attraverso questa tabella puoi verificare se ci sono presenti dei brani con il titolo simile al brano che stai caricando.
                    </span>
                    <table style="border-spacing: 0; font-size: 13px; width: 100%">
                        
                    </table>
                </div>
                <label>Autore</label>
                <input type="text" name="autore">
                <label>Data di uscita</label>
                <input type="date" name="dataUscita">
                <label>Brano MP3</label>
                <input type="file" name="song" id="fileToUpload">
                <input type="submit" value="Carica" name="submit">
            </form>
        </div>
        <?php
        $target_dir = "songs/" . $_SESSION['prabarmusic']['NomeUtente'];

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $songFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (isset($_POST["submit"])) {
            //controlla formato brano
            if ($songFileType['extension'] == 'mp3') {
                //cerca se la musica esiste già
                if (is_uploaded_file($_FILES['song']['tmp_name']) && file_exists($target_dir . $_FILES["song"]["tmp_name"])) {
                    move_uploaded_file($_FILES["song"]["tmp_name"], $target_dir . $_FILES["song"]["name"]);
                } else {
                    echo "Il file esiste già.";
                }
            } else {
                echo 'Formato sbagliato';
            }
        }
        ?>
    </body>
</html>
