<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo (prototipo)</title>
    <style>
        h1  {
            text-align: center;
            font-size: 48px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        .jugador  {
            width: 24%;
            margin: 1px;
            float: left;
        }
        .marcado {
            background-color: red;
            font-weight: bold;
        }
        .ganado {
            background-color: green;
            font-weight: bold;
        }
        table  {
            border: solid 1px;
            border-collapse: collapse;
        }
        th, td, tr  {
            border: solid 1px;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php session_start(); 
        include 'functions.php'; //permite usar funciones de otro fichero PHP

        if (!isset($_SESSION['bolas'])) {  //recupera el array $bolas para que no se reinicie al recargar la pagina
            $_SESSION['bolas'] = array();
        }
        if (!isset($_SESSION['jugadores'])) {  //recupera el array $jugadores que contiene todos los datos de los jugadores
            $_SESSION['jugadores'] = array('jugador1' => cartasJugador(),
            );
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['sacarBola'])) {
                if  (count($_SESSION['bolas']) < 60)  {
                    array_push($_SESSION['bolas'], sacarBola($_SESSION['bolas'])); //invoca la metodo y lo añade al final del array
                }
                else  {
                    echo "ya no hay mas bolas";
                }
            }

            if (isset($_POST['reiniciar'])) {
                $_SESSION['bolas'] = array(); //vacía el array para reiniciar la pagina
                $_SESSION['jugadores'] = array('jugador1' => cartasJugador());
            }
        }


    ?>
    <h1>Bingo (prototipo)</h1>
    <div class="jugador" id="j1"><p>Jugador 1</p>
        <?php
        //jugador, y los 3 cartones
            foreach ($_SESSION['jugadores']['jugador1'] as $carton)  {
                imprimirCarton($carton, $_SESSION['bolas']);
            }
        ?>
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <button type="submit" name="sacarBola">Sacar Bola</button>
        <button type="submit" name="reiniciar">Reiniciar</button>
    </form>

    <div>
        <?php 
            foreach($_SESSION['bolas'] as $valor) {
                echo '<img src="images/'.($valor).'.png" />';
            }
        
        ?>
    </div>


</body>
</html>