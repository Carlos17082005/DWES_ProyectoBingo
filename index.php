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
            margin: 1px;
            border: 5px solid;
            float: left;
        }
        #j1 {
            border-color: red;
        }
        #j2 {
            border-color: green;
        }
        #j3 {
            border-color: blue;
        }
        #j4 {
            border-color: purple;
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
        <button type="submit" name="inicio">Empezar Juego</button><br>
    </form>

    <div>
        <?php 
            include 'functions.php'; //permite usar funciones de otro fichero PHP
            $bolas = array();  //crea el array que va a guardar las bolas que vayan saliendo

            $jugadores = array(  //crea un array asosiativo que guarda los cartones de todos los jugadores
                'jugador1' => cartasJugador(),
                'jugador2' => cartasJugador(),
                'jugador3' => cartasJugador(),
                'jugador4' => cartasJugador()
            );

            if ($_SERVER["REQUEST_METHOD"] == "POST") {  //se ejecuta al pulsar el boton
                $bool = false;
                while(!$bool)  {  //ejecuta el bucle hasta que haya un ganador, cuando detecta un ganador lo imprime y verifica los otros por si hay otro ganador
                    if (ganador($jugadores['jugador1'], $bolas))  {
                        echo "<h2>Ganador Jugador 1</h2>";
                        $bool = true;
                    }
                    if (ganador($jugadores['jugador2'], $bolas))  {
                        echo "<h2>Ganador Jugador 2</h2>";
                        $bool = true;
                    }
                    if (ganador($jugadores['jugador3'], $bolas))  {
                        echo "<h2>Ganador Jugador 3</h2>";
                        $bool = true;
                    }
                    if (ganador($jugadores['jugador4'], $bolas))  {
                        echo "<h2>Ganador Jugador 4</h2>";
                        $bool = true;
                    }
                    if (!$bool)  {  //si no hay jugador saca otra bola
                        array_push($bolas, sacarBola($bolas));
                    }
                }
            }

            //imprime los cartones de los jugadores (estetico)

            echo '<div class="jugador" id="j1"><p>Jugador 1</p>';
            foreach ($jugadores['jugador1'] as $carton)  {
                imprimirCarton($carton, $bolas);
            }
            echo '</div>';
            
            echo '<div class="jugador" id="j2"><p>Jugador 2</p>';
                    foreach ($jugadores['jugador2'] as $carton)  {
                        imprimirCarton($carton, $bolas);
                    }                
            echo '</div>';

            echo '<div class="jugador" id="j3"><p>Jugador 3</p>';
                    foreach ($jugadores['jugador3'] as $carton)  {
                        imprimirCarton($carton, $bolas);
                    }
            echo '</div>';

            echo '<div class="jugador" id="j4"><p>Jugador 4</p>';
                    foreach ($jugadores['jugador4'] as $carton)  {
                        imprimirCarton($carton, $bolas);
                    }
            echo '</div>';

            //imprime las bolas con los numeros

            echo '<div style="width: 100%;">';
            foreach($bolas as $valor) {
                echo '<img src="images/'.($valor).'.png" />';
            }
            echo '</div>';
        ?>
    </div>


</body>
</html>