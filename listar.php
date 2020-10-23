<?php

require 'conexion.php';
$conexion = conectarBD();

$query = "SELECT p.num_legajo as legajo, 
				 p.apellido as apellidograduado, 
				 p.nombre as nombregraduado, 
				 l.nombre as localidad, 
				 c.nombre as carrera, 
				 p.aniocolacion as anio
		   FROM persona p 
		   		INNER JOIN 
				localidad l 
				ON (p.localidad_fk = l.id) 
				INNER JOIN carreraregional cr 
				ON (p.carreraregional_fk = cr.id) 
				INNER JOIN carrera c 
				ON (cr.carrera_fk = c.id)";

$resultado = pg_query($conexion, $query);

$return_arr = array();

if( !$resultado ){
	die("Error");
}else{
	/*while( $data = pg_fetch_assoc($resultado) ){
		
		$arreglo["data"][] = $data['legajo'];
		$arreglo["data"][] = $data['apellidograduado'];
		$arreglo["data"][] = $data['nombregraduado'];
		$arreglo["data"][] = $data['localidad'];
		$arreglo["data"][] = $data['carrera'];
		$arreglo["data"][] = $data['anio'];

		array_push($return_arr, $arreglo));		
	}
	echo json_encode(convertirUTF8($return_arr);
	*/

	while( $data = pg_fetch_assoc($resultado) ){
		$arreglo["data"][] = array_map("utf8_encode", $data);
		//array_push($arreglo["data"][], convertirUTF8($arreglo));
	}

	echo json_encode($arreglo);

}

pg_free_result($resultado);
pg_close($conexion);