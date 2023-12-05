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
				case "PUT":
					$json = array(
						"statusCode" => "200",
						"detalle" => "ESTAS EN EL TABLERO " . $rutas[3] . "con el metodo PUT"
					);
				
					echo json_encode($json, http_response_code($json["statusCode"]) );
					return;

				case "DELETE": 
					$json = array(
						"statusCode" => "401",
						"detalle" => "ESTAS EN EL TABLERO " . $rutas[3] . "con el metodo DELETE"
					);
				
					echo json_encode($json, http_response_code($json["statusCode"]) );
					return;
				case "GET": 
					$json = array(
						"statusCode" => "200",
						"detalle" => "ESTAS EN EL TABLERO " . $rutas[3] . "con el metodo GET"
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
				$json = array(
					"statusCode" => "201",
					"detalle" => "ESTAS EN TABLEROS con el metodo POST"
				);
			
				echo json_encode($json, http_response_code($json["statusCode"]) );
				return;

			case "GET":

				$tableros = new TablerosService();
				$tableros->crearTablero();
				return;

			case "PUT":
				$json = array(
					"statusCode" => "200",
					"detalle" => "ESTAS EN TABLEROS con el metodo PUT"
				);
			
				echo json_encode($json, http_response_code($json["statusCode"]) );
				return;

			case "DELETE":
				$json = array(
					"statusCode" => "401",
					"detalle" => "ESTAS EN TABLEROS con el metodo DELETE"
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

	default: 
		$json = array(
			"statusCode" => "404",
			"detalle" => "NOT FOUND"
		);
		
		echo json_encode($json, http_response_code($json["statusCode"]) );

}