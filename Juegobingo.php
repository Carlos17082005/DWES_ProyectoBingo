<?php
    
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
