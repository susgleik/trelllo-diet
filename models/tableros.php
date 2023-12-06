<?php 

require_once "conexion.php";

class Tablero { 

	public function __construct($tablero){
		$this->idTablero = $tablero["idTablero"];
		$this->nombre = $tablero["nombre"];
		$this->created_at = $tablero["created_at"];
		$this->updated_at = $tablero["updated_at"];
    }

	static function crearTablero($nombre){

		//Necesito la referencia del metodo estatico para obtener el ultimo id agregado
		$con = Conexion::conectar();

		$statement = $con-> prepare("INSERT INTO tableros (nombre) VALUES (:nombre)");

		$statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);

		if($statement->execute()){
			//La api busca devolver el ultimo objeto agregado, por lo que requerimos el id del objeto recien creado para obtener todos sus valores.
			$id = $con->lastInsertId();
			$statement = Conexion::conectar()->prepare("SELECT * FROM tableros WHERE id_tablero = :id");
			$statement->bindParam(":id", $id, PDO::PARAM_INT);
			$statement->execute();

			//se devuelve el objeto recien creado
			return $statement->fetch(PDO::FETCH_ASSOC);
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
	}

	static function obtenerTableros(){
		try{
			$statement = Conexion::conectar()->prepare("SELECT * FROM tableros");
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}catch(PDOException $e){
			print_r(Conexion::conectar()->errorInfo());
		}

		return null;
	}

	static function obtenerTablero($id){
		try{
			$statement = Conexion::conectar()->prepare("SELECT * FROM tableros WHERE id_tablero = :id");
			$statement->bindParam(":id", $id, PDO::PARAM_INT);

			$statement->execute();

			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}catch(PDOException $e){
			print_r(Conexion::conectar()->errorInfo());
		}

		return null;
	}

	static function actualizarTablero($tablero){
		$fecha = date('Y-m-d');
		$statement = Conexion::conectar()-> prepare("UPDATE tableros SET nombre =:nombre, updated_at=:fecha WHERE id_tablero = :id");

		$statement->bindParam(":nombre", $tablero["nombre"], PDO::PARAM_STR);
		$statement->bindParam(":fecha", $fecha, PDO::PARAM_STR);
		$statement->bindParam(":id", $tablero["id_tablero"], PDO::PARAM_INT);

		if($statement->execute()){
			//La api busca devolver el ultimo objeto agregado, por lo que requerimos el id del objeto recien creado para obtener todos sus valores.
			$statement = Conexion::conectar()->prepare("SELECT * FROM tableros WHERE id_tablero = :id");
			$statement->bindParam(":id", $tablero["id_tablero"], PDO::PARAM_INT);
			$statement->execute();

			//se devuelve el objeto recien creado
			return $statement->fetch(PDO::FETCH_ASSOC);
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
	}

	static function eliminarTablero($id){
		$statement = Conexion::conectar()-> prepare("DELETE FROM tableros WHERE id_tablero = :id");

		$statement->bindParam(":id", $id, PDO::PARAM_INT);

		if($statement->execute()){
			return true;
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}

		return false;

	}


}