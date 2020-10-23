<?php

function conectarBD() {
    $host = 'host=localhost';
    //$dbname = 'dbname=db';
    //$port = 'port=5432';
    //$user = 'user=postgres';
    //$password = 'password=0000';

    $cadenaConexion = "$host $port $dbname $user $password";

    $conexion = pg_connect($cadenaConexion);

    if (!$conexion) {
        echo "Error: " . pg_last_error();
    } else {
        return $conexion;
    }
}

function convertirUTF8($array){
    array_walk_recursive($array, function(&$item,$key) {
        if(!mb_detect_encoding($item,'utf-8',true)){
            $item = utf8_encode($item);
        }
    });
    return $array;
}