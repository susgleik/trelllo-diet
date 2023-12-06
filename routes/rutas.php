<?php

$rutas = explode("/", $_SERVER['REQUEST_URI']);
$rutas = array_filter($rutas);

switch ($rutas[2]) {

	/*********
		TABLEROS
		********/
	case "tableros":

		/*********
		TABLEROS ESPECIFICOS
		********/
		if (isset($rutas[3])) {

			/*********
			METODOS HTTP
			********/
			switch ($_SERVER["REQUEST_METHOD"]) {
				case "DELETE":
					$service = new TablerosService();
					$service->eliminarTablero($rutas[3]);

					$json = array(
						"statusCode" => "204",
						"detalle" => "Tablero eliminado"
					);
				
					echo json_encode($json, http_response_code($json["statusCode"]) );

					return;
				case "GET":
					$service = new TablerosService();
					$tablero = $service->obtenerTablero( $rutas[3] );

					$json = array(
						"statusCode" => "200",
						"detalle" => $tablero
					);
				
					echo json_encode($json, http_response_code($json["statusCode"]) );
					return;

				default: 
					$json = array(
						"statusCode" => "400",
						"detalle" => "ESTAS EN EL TABLERO " . $rutas[3] . " y no hay soporte para este metodo"
					);
				
					echo json_encode($json, http_response_code($json["statusCode"]) );
					return;

			}
		}


		/*********
		TABLEROS GENERAL 
		
		METODOS HTTP
		********/
		switch ($_SERVER["REQUEST_METHOD"]) {
			case "POST":

				$tablero = $_POST["nombre"];
				$service = new TablerosService();
				$tablero = $service->crearTablero($tablero);

				$json = array(
					"statusCode" => "201",
					"detalle" => $tablero
				);
			
				echo json_encode($json, http_response_code($json["statusCode"]) );
				return;

			case "GET":
				$service = new TablerosService();
				$tableros = $service->obtenerTableros();

				$json = array(
					"statusCode" => "200",
					"detalle" => $tableros
				);
			
				echo json_encode($json, http_response_code($json["statusCode"]) );
				return;

			case "PUT":
				$datos = file_get_contents("php://input");
				$datos = json_decode($datos, true);
				$tablero = array(
					"id_tablero"=> $datos["id_tablero"],
					"nombre"=> $datos["nombre"]
				);

				$service = new TablerosService();
				$tableros = $service->actualizarTablero($tablero);


				$json = array(
					"statusCode" => "200",
					"detalle" => $tableros
				);
			
				echo json_encode($json, http_response_code($json["statusCode"]) );
				return;
			default: 
				$json = array(
					"statusCode" => "404",
					"detalle" => "ESTAS EN TABLEROS Y NO HAY SOPORTE PARA ESE METODO"
				);
			
				echo json_encode($json, http_response_code($json["statusCode"]) );
				return;
		}

	/*********
		TAREAS
		********/
	case "tareas":
		$json = array(
			"statusCode" => "200",
			"detalle" => "ESTAS EN tareas"
		);
	
		echo json_encode($json, http_response_code($json["statusCode"]) );
		return;

	/*********
	AUTH
	********/
	case "auth":
		switch( $rutas[3] ) {
			case "registro":
				
				return;
			case "acceder":
				return;
			default:
			    return;
		}

	default: 
		$json = array(
			"statusCode" => "404",
			"detalle" => "NOT FOUND"
		);
		
		echo json_encode($json, http_response_code($json["statusCode"]) );

}