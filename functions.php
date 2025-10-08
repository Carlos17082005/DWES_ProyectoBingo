<?php
    function imprimirCarton()  { //imprme el carton en forma de tabla
        echo "<table>";
        $a=carta();
        foreach ($a as $fila) {
            echo "<tr>"; 
            foreach ($fila as $valor) {
                echo "<td>".$valor."</td>"; 
            }
            echo "</tr>"; 
        }
        echo "</table>";
    }
    
    $bolas=array(); //array que guarda todas las bolas que van saliendo
    function sacarBola()  { //saca un numero aleatorio del 1 al 60
        $bola=(int)rand(1,60);
        echo '<p style="color: red;">'.$bola.'</p>';
        return $bola;
    }

    function carta()
    {
        $carta=array();
        $numerosUsados = []; //guardar todos los numeros ya usados para evitar numeros repetidos

        for($i=0;$i<3;$i++) //3 filas
        {
            $fila = array_fill(0,7,null); // se crea una fila con 7 columnas, todas inicialmente null
            
            // Elegir 5 posiciones aleatorios diferentes dentro de la fila
            $posiciones = [];
            while (count($posiciones) < 5){
                $pos = rand(0,6); //indice entre 0 y 6
                if (!in_array($pos, $posiciones))
                    $posiciones[] = $pos;
            }

            // Asignar numeros aleatorios en esas posiciones
            foreach ($posiciones as $columna){
                do{
                    // Asignar números según la columna
                    switch($columna){
                        case 0:
                            $num = rand(1,9);
                            break;
                        case 1:
                            $num = rand(10,19);
                            break;
                        case 2:
                            $num = rand(19,29);
                            break;
                        case 3:
                            $num = rand(30,39);
                            break;
                        case 4:
                            $num = rand(40,49);
                            break;
                        case 5:
                            $num = rand(50,59);
                            break;
                        case 6:
                            $num = 60;
                            break;
                } while (in_array($num, $numerosUsados)); // Para que no se repita

                $fila[$columna] = $num;
                $numerosUsados[] = $num;
            }

            // Añadir fila a la carta
            $carta[] = $fila;

        }
        return $carta;
    }
    
    function cartasJugador()
    {
        $cartas = array();
        for($i=0; $i < 3;$i++)
        {
            $cartas[] = carta();
        }
        return $cartas;
    }

    $jugador1 = cartasJugador();
    $jugador2 = cartasJugador();
    $jugador3 = cartasJugador();
    $jugador4 = cartasJugador();


?>
