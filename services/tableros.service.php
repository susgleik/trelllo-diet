<?php

class TablerosService {

	public function crearTablero() {

		$json = array(
			"statusCode" => "200",
			"detalle" => "ESTAS EN TABLEROS con el metodo GET"
		);
	
		echo json_encode($json, http_response_code($json["statusCode"]) );

	}

}