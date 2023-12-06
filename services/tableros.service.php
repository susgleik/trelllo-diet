<?php

class TablerosService {

	public function crearTablero($nombre) {
		return Tablero::crearTablero($nombre);
	}

	public function obtenerTableros() {
		return Tablero::obtenerTableros();
	}

	public function actualizarTablero($tablero){
		return Tablero::actualizarTablero($tablero);
	}

	public function eliminarTablero($id) {
		return Tablero::eliminarTablero($id);
	}

	public function obtenerTablero($id){
		return Tablero::obtenerTablero($id);
	}

}