<?php
    function imprimirCarton($carton, $bolas)  { // Imprme el carton en forma de tabla
        // Recibe un array bidimencional que hace de carton de bingo ($carton) y un array con todos los numeros que han salido ($bolas)
        // No devuelve nada, imprime directamente la tabla
        $bool = ganador($carton, $bolas);  //Le asigno el valor a una varible para no llamar a la funcion todas las veses
        $text = "<table>";
        foreach ($carton as $fila) {
            $text .=  "<tr>"; 
            foreach ($fila as $valor) {
                if ($bool)  {  // Si el carton es ganador, lo pinta entero
                    $text .= '<td class="ganado">'.$valor.'</td>';  
                }
                else  {
                    if (in_array($valor, $bolas))  {  // Si detecta que el numero ya salio, marca la casilla
                        $text .= '<td class="marcado">'.$valor.'</td>'; 
                    } 
                    else  {
                        $text .= '<td>'.$valor.'</td>';   // Si el numero no ha salido, no la marca
                    }
                }
            }
            $text .= "</tr>";
        }        
        $text .= "</table><br>";
        echo $text;
    }

    function ganador($carton, $bolas)  { // Comprueba si el carton es ganador
        // Recibe un array bidimencional que hace de carton de bingo ($carton) y un array con todos los numeros que han salido ($bolas)
        // Devuelve un booleano
        $ganador = 0;
        foreach ($carton as $fila) {
            foreach ($fila as $valor) {
                if (in_array($valor, $bolas))  {
                    $ganador++;
                } 
            }
        }
        if ($ganador == 15)  {  // Si el carton esta completo (15/15) devuelve un true y se sale de la funcion
            return true;
        }
        return false;  // Si esta incompleto devuelve false para que añada otro numero
    }

    function sacarBola($bolas)  {  //saca un numero (bola) aleatorio del 1 al 60
        // Recibe un array con todos los numeros que han salido ($bolas)
        // Devuelve un numero (bola)
        $bola=(int)rand(1,60);
        while (TRUE && count($bolas) < 60)  {  // Se ejecuta siempre hasta que halle un numero o salgan todos (60/60)
            if (!in_array($bola, $bolas))  {  // Si la bola no a salido, devuelve la bola y sale de la funcion 
                return $bola;
            }
            $bola=(int)rand(1,60);
        }
    }

    function carton()  {  // Crea los cartones de bingo
        // Devuelve un array bidimencional que hace de carton de bingo
        $carton = array();
        $numerosUsados = array(); // Guardar todos los numeros ya usados para evitar numeros repetidos

        for($i = 0; $i < 3; $i++)  { // 3 filas
            $fila = array_fill(0, 7, null); // Se crea una fila con 7 columnas, todas inicialmente null
            
            // Elegir 5 posiciones aleatorios diferentes dentro de la fila
            $posiciones = array();
            while (count($posiciones) < 5)  {
                $pos = rand(0, 6); // Indice entre 0 y 6
                if (!in_array($pos, $posiciones))
                    $posiciones[] = $pos;
            }

            foreach ($posiciones as $columna)  {  // Asignar numeros aleatorios en esas posiciones
                if ($columna == 6 && in_array(60, $numerosUsados))  {
                    do {
                        $columna = rand(0, 5); // Cambia a otra columna 
                    } while (in_array($columna, $posiciones)); 
                    $posiciones[] = $columna;
                }
                do  {
                    switch($columna)  {  // Asignar números según la columna
                        case 0:  $num = rand(1,9);  break;
                        case 1:  $num = rand(10,19);  break;
                        case 2:  $num = rand(20,29);  break;
                        case 3:  $num = rand(30,39);  break;
                        case 4:  $num = rand(40,49);  break;
                        case 5:  $num = rand(50,59);  break;
                        case 6:  $num = rand(60, 60);  break;
                    }
                }  while (in_array($num, $numerosUsados)); // Para que no se repita

                $fila[$columna] = $num;
                $numerosUsados[] = $num;
            }
            $carton[] = $fila;  // Añadir fila al carton
        }
        $carton = ordenar($carton);
        return $carton;
    }

    function ordenar($carton)  {  // Ordena el array que hace de carton pr columnas de forma ascendente
        // Recibe un array bidimencional que hace de carton de bingo ($carton)
        // Devuelve el mismo carton pero ordenado
        for ($i = 0; $i < 7; $i++)  { // Ordena los numeros de menor a mayor por columnas
            $columna = array();  // Guarda los numeros y espacios vacios de la columna
            for ($j = 0; $j < 3; $j++)  {  
                if ($carton[$j][$i] != null)  {
                    $columna[] = $carton[$j][$i];
                }
            }
            sort($columna);
            $contadorColumna = 0;
            for ($j = 0; $j < 3; $j++)  {  // Reasigna los numeros en orden al array dejando los huecos
                if ($carton[$j][$i] != null)  {
                    $carton[$j][$i] = $columna[$contadorColumna];
                    $contadorColumna++;
                }
            }
        }
        return $carton;
    }
    
    function cartonesJugador($numC)  {  // Asigna n cartones a cada jugador
        // Resive el numero de cartones para cada jugador
        // Devuelve un array con n arrays bidimencionales que hacen de cartones de bingo
        $cartones = array();
        for($i = 1; $i <= $numC; $i++)  {
            $cartones['carton '.$i] = carton();
        }
        return $cartones;
    }

    function crearJugadores($numJ, $numC)  {  // Crea un array asosiativo que guarda los cartones de todos los jugadores
        // Resibe el numero de jugadores que hay que crear y con cuantos cartones 
        // Devuelve un array con los jugadores
        $jugadores = array();
        for($i = 1; $i <= $numJ; $i++)  {
            $jugadores['Jugador '.$i] = cartonesJugador($numC);
        }
        return $jugadores;
    }
?>
