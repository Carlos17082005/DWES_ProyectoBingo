<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo</title>
    <style>
        body  {
            font-family: Arial, Helvetica, sans-serif;
        }
        h1  {
            text-align: center;
            font-size: 48px;
            font-weight: bold;
        }
        p  {
            font-size: 24px;
            text-align: center;
            font-weight: bold;
        }
        .jugador  {
            width: 24%;
            margin: 2px;
            border: 5px solid;
            float: left;
        }
        .marcado {
            background-color: red;
            font-weight: bold;
        }
        .ganado {
            background-color: lightgreen;
            font-weight: bold;
        }
        table  {
            margin: auto;
            border: solid 3px;
            border-collapse: collapse;
        }
        th, td, tr  {
            text-align: center;
            border: solid 1px;
            border-collapse: collapse;
            width: 25px;
            height: 25px;
        }
        form  {
            text-align: center;
        }
        button  {
            font-size: 24px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Bingo</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Numero jugadores: </label>
        <input type="number" name="jugador" min="0" required><br></br>

        <label>Numero cartones: </label>
        <input type="number" name="carton" min="0" required><br></br>
        
        <button type="submit" name="inicio">Empezar Juego</button><br>
    </form>

    <div>
        <?php 
            include 'functions.php'; // Permite usar funciones de otro fichero PHP
            $bolas = array();  // Crea el array que va a guardar las bolas que vayan saliendo

            if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Se ejecuta al pulsar el boton
                $jugadores = crearJugadores($_POST['jugador'], $_POST['carton']);
                $bool = false;
                $text = "Ganador: ";  //Aqui se guardara la informacion del ganador
                while(!$bool)  {  // Ejecuta el bucle hasta que haya un ganador, cuando detecta un ganador lo imprime y verifica los otros por si hay otro ganador
                    foreach($jugadores as $claveJ => $jugador)  {
                        foreach($jugador as $claveC => $carton)  {
                            if (ganador($carton, $bolas))  {  // Guarda la informacion del ganador usando las claves de los arrays asosiativos
                                $text .= "<br>&ensp;&ensp;&ensp;&ensp;&ensp; - ".$claveJ." con el ".$claveC;
                                $bool = true;  // Para salir del bucle y no sacar mas bolas
                            }
                        }
                    }
                    if (!$bool)  {  // Si no hay carton ganador saca otra bola
                        array_push($bolas, sacarBola($bolas));
                    }
                }
                echo "<h2>".$text."</h2>";  // Imprime el ganador

                // Imprime los cartones de los jugadores 
                foreach($jugadores as $claveJ => $jugador)  {
                        echo '<div class="jugador"><p>'.$claveJ.'</p>';
                        foreach($jugador as $carton)  {
                            imprimirCarton($carton, $bolas);
                        }
                        echo '</div>';
                }

                // Imprime las bolas con los numeros
                echo '<div style="width: 100%;">';
                foreach($bolas as $valor) {
                    echo '<img src="images/'.($valor).'.png" />';
                }
                echo '</div>';
            }
        ?>
    </div>
</body>
</html>
