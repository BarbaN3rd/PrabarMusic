<html>
    <head></head>
    <body>
	<link rel="stylesheet" href="style_dir/style_global.css" />
	<style>
            img {
                height: 40px;
                width: 40px;
                vertical-align: middle;
                margin-right: 15px;
            }
            
            div#container {
                font-size: 18px;
                letter-spacing: -1px;
                margin-top: 15%;
                text-align: center;
            }
	</style>
        <?php
        session_start();
        require 'dbconnection.php';

        $passNuova = $_POST['passN'];
        $passVecchia = $_POST['passV'];

        $nUtente = $_SESSION['prabarmusic']['NomeUtente'];
        $passwordNU = $_SESSION['prabarmusic']['Password'];

        $sql = "UPDATE Utente SET Password = '$passNuova' WHERE NomeUtente = '$nUtente';";
        $ris = $conn->query($sql);


        if ($ris && ($passwordNU == $passVecchia)) {
            echo "<div id='container'><img src='images/ok.png'><span class='bold'>Password cambiata</span>. Ora verrai rimandato nuovamente al tuo profilo.</div>
        <script>
            setTimeout(function () {
                window.location.href='profile.php';
            }, 5000);
        </script>";
        $_SESSION['prabarmusic']['Password'] = $passNuova;
        } else {
            echo "<div id='container'><img src='images/not.png'><span class='bold'>Password non cambiata</span>. Ora verrai rimandato nuovamente al tuo profilo.</div>
        <script>
            setTimeout(function () {
                window.location.href='profile.php';
            }, 5000);
        </script>";
        }
        ?>
    </body>
</html>