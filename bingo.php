<?php
    
    function carta()
    {
        $carta=array(); 

        for($i=0;$i<3;$i++) //3 filas
        {
            $fila = array();
            for ($j=0;$j<7;$j++) //7 columnas 3*7=21numeros
            {
                $fila[]=null; //de momento vacio
            }
            $carta[]=$fila; // agregar la fila a la carta
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