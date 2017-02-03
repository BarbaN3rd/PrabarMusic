<?php

session_start();

?>
<html>
    <head>
        <title>Prabar Music</title>
    </head>
    <body>
        <link rel="stylesheet" href="style_dir/style_global.css" >
        <link rel="stylesheet" type="text/css" href="style_dir/style_index.css">
        <script src='jquery/jquery-3.1.1.min.js'></script>
        <script src='jquery/ajax_index.js'></script>
        <div class="header">
            <div class="nav-wrapper">
                <div class="site-nav">
                    <ul>
                        <li class="nav-item selected"><a href="#">Prabar Music</a></li>
                        <li class="nav-item"><a href="#">Brani</a></li>
                        <li class="nav-item"><a href="#">Account</a></li>
                        <?php
                        
                        include("utility.php");
                        if (isLogged()) {
                            echo "<li class='nav-item'><a href='logout.php'>Logout</a></li>";
                        } 
                        else 
                        {
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
            <?php

            error_reporting(E_ALL ^ E_NOTICE);

            require 'dbconnection.php';

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM Brani";
            $result = $conn->query($sql);
            echo "<div class='titletop'>Le nostre canzoni</div>";
            echo "<table>";
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
        </div>
    </body>
</html>