<?php
session_start();

header('Content-Type: text/html; charset=utf-8');

include("utility.php");

if (isLogged()) {
    header('location: index.php');
}
?>
<html>
    <head>
        <title>Registrazione</title>
    </head>
    <body>
        <style>
            label {margin-top: 5px;}
            h1 {text-align: center;}
            hr {border-color: #393939}
            
            #ok {display: none; font-size: 12px;}
            
            img {
                height: 40px;
                width: 40px;
                vertical-align: middle;
                margin-right: 15px;
            }
            
            #container {
                font-size: 18px;
                letter-spacing: -1px;
                margin-top: 30px;
                text-align: center;
            }


        </style>
        <script src='jquery/jquery-3.1.1.min.js'></script>
        <script src='jquery/ajax_signup.js'></script>
        <link rel="stylesheet" href="style_dir/style_signup.css">
        <link rel="stylesheet" href="style_dir/style_global.css" >
        <link rel="stylesheet" href="style_dir/style_login.css" >
        <script>
            function controllapwd() {
                pass1 = document.getElementById("passwd1").value;
                pass2 = document.getElementById("passwd2").value;
                nascondi = document.getElementById("errorpwd");
                if (pass1 == pass2) {
                    nascondi.style.display = "none";
                } else {
                    nascondi.style.display = "block";
                }
            }
        </script>
        <div id="five">
            <h1>Crea un account PRABAR MUSIC</h1>
            <p class="info">
                Non sei cliente di PRABAR MUSIC? Registra un account adesso. La registrazione richiede pochi secondi
                e ti permette di aggiungere nuovi brani alla raccolta e la possibilità di noleggiare i brani messi a disposizione
                dagli altri utenti registrati.
            </p>
            <p class="info">
                Sei già registrato? <a style="display: inline; font-size: 13px;" href="login.html" class="new-account">Accedi qua!</a>
            </p>

            <h3>COMPLETA TUTTI I CAMPI PER REGISTRATI</h3>

            <hr>

            <div id="fourth">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <label>Nickname</label>
                    <input required style="display: inline-block;" id="nick" type="text" name="nickname" placeholder="Nickname"/>
                    <span id="ok">Prova</span>
                    <label>Nome</label>
                    <input required type="text" name="nome" placeholder="Nome"/>
                    <label>Cognome</label>
                    <input required type="text" name="cognome" placeholder="Cognome"/>
                    <label>Password</label>
                    <input required id="passwd1" onkeyup="controllapwd()" type="password" name="pass1"/>
                    <label>Conferma Password</label>
                    <input required id="passwd2" onkeyup="controllapwd()" type="password" name="pass2"/>
                    <span id="errorpwd">Le password non coincidono</span>
                    <input required type="submit" name="invio" value="ISCRIVITI"/>
                    <!-- <input type="reset" name="cancella" value="Annulla"/> -->
                </form>
            </div>
        </div>

        <?php
        require 'dbconnection.php';

        $password = $_POST["pass1"];
        $password2 = $_POST["pass2"];
        $nickname = $_POST["nickname"];
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];

        if (($password != "") && ($nickname != "") && ($nome != "") && ($cognome != "")) {

            if ($password == $password2) {

                $datai = date("Y/m/d");

                if ($conn->connect_error) {
                   echo "<div id='container'><img src='images/not.png'><span class='bold'>Errore di connessione con il database</span>. Ritenta tra qualche minuto.</div>";
                }

                $sql = "INSERT INTO Utente VALUES ('$nickname','$nome','$cognome','$datai','$password');";
                $risposta = $conn->query($sql);
                if (!$risposta) {
                    echo "<div id='container'><img src='images/not.png'><span class='bold'>Nome utente già utilizzato</span>. Ritenta utilizzandone uno diverso.</div>";
                    exit();
                }
                /* creiamo le cartelle dedicate all'utente */
                mkdir("songs/" . $nickname);
                mkdir("songs/" . $nickname . "/music");
                /* ritorniamo alla pagina di login per effettuare il login */
                echo "<div id='container'><img src='images/ok.png'><span class='bold'>Account creato con successo</span>. Ora verrai reindirizzato alla pagina di login.</div>
                <script>
                    setTimeout(function () {
                        window.location.href='login.html';
                    }, 5000);
                </script>";
            } else {
                echo "<div id='container'><img src='images/not.png'><span class='bold'>Le due password non coincidono</span>. Puoi ritentare nuovamente.</div>";
            }
        }
        ?>
    </body>
</html>