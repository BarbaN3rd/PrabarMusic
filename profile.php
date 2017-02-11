<?php
session_start();

header('Content-Type: text/html; charset=utf-8');

require 'dbconnection.php';
include("utility.php");

if (!isLogged()) {
    header('location: login.html');
}
?>

<html>
    <head>
        <?php echo "<title>" . $_SESSION['prabarmusic']['NomeUtente'] . "</title>"; ?>
    </head>
    <body>
        <link rel="stylesheet" href="style_dir/style_global.css" >
        <link rel="stylesheet" type="text/css" href="style_dir/style_login.css">
        <link rel="stylesheet" type="text/css" href="style_dir/style_profile.css">
        <link rel="stylesheet" type="text/css" href="style_dir/style_index.css">
        <script src='jquery/jquery-3.1.1.min.js'></script>
        <script src="jquery/js_profile.js"></script>

        <style>
            /* STILI FORMATTAZIONE PAGINA (NO MODAL BOX) */

            .red {background-color: #db0000; border: 1px solid #df0000;}
            .red:hover {background-color: #c30000; color: #fff; border: 1px solid #df0000;}

            input {padding-left: 4px;}

        </style>
        <div class="header">
            <div class="nav-wrapper">
                <div class="site-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php">Prabar Music</a></li>
                        <li class="nav-item"><a href="#">Brani</a></li>
                        <?php
                        if (isLogged()) {
                            echo "<li class='nav-item selected'><a class='bold' href='profile.php'>Account</a></li>";
                            echo "<li class='nav-item'><a href='upload.php'>Carica</a></li>";
                            echo "<li class='nav-item'><a href='logout.php'>Logout</a></li>";
                        } else {
                            echo "<li class='nav-item'><a href='login.html'>Login</a></li>";
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
            <h1>Ciao <?php echo $_SESSION['prabarmusic']['Nome']; ?>, ecco i tuoi dati</h1>
            <p class="details">
<?php
echo "<span class='bold'>Nome utente</span>: " . $_SESSION['prabarmusic']['NomeUtente'] . "<br>";
echo "<span class='bold'>Nome</span>: " . $_SESSION['prabarmusic']['Nome'] . "<br>";
echo "<span class='bold'>Cognome</span>: " . $_SESSION['prabarmusic']['Cognome'] . "<br>";

$originalDate = $_SESSION['prabarmusic']['DataIscrizione'];
$newDate = date("d-m-Y", strtotime($originalDate));

echo "<span class='bold'>Data di iscrizione</span>: " . $newDate . "<br>";
?>
            </p>

            <div class="box-botton">
                <a href="#" id="changeInfo" class="modify">Modifica i dati</a><a href="#" id="changePwd" class="modify red">Modifica password</a>
            </div>

            <!-- Box cambia informazioni -->
            <div id="myModal" class="modal-changeInfo">
                <div class="modal-content-changeInfo">
                    <span class="close-changeInfo">&times;</span>
                    <p class="details">                    

                    <form method="POST" action="editUser.php">
                        <h1>Modifica i tuoi dati</h1>
                        <p class="norm" style="color: #222222; font-size: 14px;">
                            In questa schermata puoi modificare il <span class="bold">nome</span> e <span class="bold">cognome</span> relativi al tto account.
                            Questa operazione può essere effettuata quante volte si desidera.
                        </p>
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <span class="bold" style="font-size: 13px">Nome</span>
                                </td>
                                <td>
                                    <span class="bold" style="font-size: 13px">Cognome</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input value="<?php echo $_SESSION['prabarmusic']['Nome']; ?>" type="text" name="nome">
                                </td>
                                <td>
                                    <input value="<?php echo $_SESSION['prabarmusic']['Cognome']; ?>" type="text" name="cognome">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="Modifica">
                                </td>
                            </tr>
                        </table>
                    </form>

                    </p>
                </div>
            </div>

            <!-- Box cambia informazioni -->
            <div id="myModal" class="modal-changePwd">
                <div class="modal-content-changePwd">
                    <span class="close-changePwd">&times;</span>
                    <form method="POST" action="changePwd.php">
                        <h1>Modifica i tuoi dati</h1>
                        <p class="norm" style="color: #222222; font-size: 14px;">
                            In questa schermata puoi modificare la tua <span class="bold">password</span> relativa al tuo account.
                            Questa operazione può essere effettuata quante volte si desidera.<br>
                            Attenzione però, lo strumento di recupero della password è ancora in fase di sviluppo: <span class="bold">presta
                                attenzione ad inserirla correttamente</span>.
                        </p>
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <span class="bold" style="font-size: 13px">Password precedente</span>
                                </td>
                                <td>
                                    <span class="bold" style="font-size: 13px">Password nuova</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="passV">
                                </td>
                                <td>
                                    <input type="password" name="passN">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="Modifica">
                                </td>
                            </tr>
                        </table>
                    </form>

                    </p>
                </div>
            </div>

            <h1>Brani da te caricati</h1>
            <p class="norm" style="color: #222222; font-size: 15px;">
                Questi sono i brani che hai caricato tu nel sito. In questa parte <span class="bold">puoi gestirli nel modo che preferisci</span>.
            </p>


<?php
$nUtente = $_SESSION['prabarmusic']['NomeUtente'];

//$sql = "SELECT * FROM Brani, Prestiti WHERE Prestiti.NomeUtente = '$nUtente' AND Prestiti.IDBrano = Brani.IDBrano;";
$sql = "SELECT Titolo, Prestiti.NomeUtente FROM Brani, Prestiti WHERE Brani.NomeUtente = 'Barba' AND Brani.IDBrano = Prestiti.IDBrano;";

$result = $conn->query($sql);
echo "<div class='titletop'>Le nostre canzoni</div>";
echo "<table class='songs'>";
$i = 1;
while ($riga = $result->fetch_assoc()) {
    echo "<tr class='mostra'><td class='number'>" . $i . "<td><span style='font-weight: 700'>" . $riga["Titolo"] . "</span>
                        <br><span style='font-size: 12px'>" .
    $riga["Autore"] . "</span>" .
    "<br><span style='font-size: 13px; font-style: italic;'>
                            Caricato da " . $riga["NomeUtente"] .
    "</span></td>";
    if ((isLogged()) && ($riga['Disponibilita'] == 0)) {
        echo "<td class='" . $riga['IDBrano'] . "' style='text-align: center'>
                              <a href='#' class='add' id='" . $riga["IDBrano"] . "'></a>
                    </td>
                </tr>";
    } elseif ((isLogged()) && ($riga['Disponibilita'] == 1)) {
        echo "<td class='" . $riga['IDBrano'] . "' style='text-align: center;'><div class='not-aviable'><span>Brano già nolleggiato</span></div></td></tr>";
    } else {
        echo "<td>Per aggiungere un brano devi essere registrato e connesso</td>";
    }
    $i++;
}
echo "</table>"
?>

            <h1>Elimina account
        </div>
    </body>
</html>
