<?php
    function imprimirCarton($carton, $marcar)  { //imprme el carton en forma de tabla (estetico)
        $ganador = 0;  //contabilisa las casillas marcadas
        $text = "<table>";
        foreach ($carton as $fila) {
            $text .=  "<tr>"; 
            foreach ($fila as $valor) {
                if (in_array($valor, $marcar))  {  //si detecta que el numero ya salio, marca la casilla
                    $text .= '<td class="marcado">'.$valor.'</td>'; 
                    $ganador++;
                } 
                else  {
                    $text .= '<td>'.$valor.'</td>';   //si el numero no ha salido, no la marca
                }
            }
            $text .= "</tr>"; 
        }
        if ($ganador == 15)  {  //si el carton esta completo (15/15) lo marca todo
            $text = "<table>";
            foreach ($carton as $fila) {
                $text .=  "<tr>"; 
                foreach ($fila as $valor) {
                    $text .= '<td class="ganado">'.$valor.'</td>'; 
                }
            } 
        }
        $text .= "</table><br>";
        echo $text;
    }

    function ganador($jugador, $bolas)  { //comprueba si el carton es ganador
        foreach ($jugador as $carton)  {
            $ganador = 0;
            foreach ($carton as $fila) {
                foreach ($fila as $valor) {
                    if (in_array($valor, $bolas))  {
                        $ganador++;
                    } 
                }
            }
            if ($ganador == 15)  {  //si el carton esta completo (15/15) devuelve un true para acabar
                return true;
            }
        }
        return false;  //si esta incompleto devuelve false para que añada otro numero
    }

    function sacarBola($bolas)  {  //saca un numero (bola) aleatorio del 1 al 60
        $bola=(int)rand(1,60);
        while (TRUE)  {
            if (!in_array($bola, $bolas))  {  //si la bola no a salido, devuelve la bola y sale de la funcion 
                return $bola;
            }
            $bola=(int)rand(1,60);
        }
    }

    function carta() //temporal
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
            foreach ($posiciones as $pos){
                do{
                    $num = rand(1,60);
                } while (in_array($num, $numerosUsados)); // Para que no se repita

                $fila[$pos] = $num;
                $numerosUsados[] = $num;
            }

            // Añadir fila a la carta
            $carta[] = $fila;

        }
        return $carta;
    }
    //Error, no funciona bien
    /*function carta()
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
    */
    
    function cartasJugador()  {
        $cartas = array();
        for($i=0; $i < 3;$i++)  {
            $cartas[] = carta();
        }
        return $cartas;
    }

?>
