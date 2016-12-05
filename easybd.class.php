<?php 
class EasyBD {
	private $bd;

	public function __construct($servidor,$usuario,$password,$basedatos)
		{
			try {
			$this->bd=new PDO("mysql:host=$servidor;dbname=$basedatos",
			     $usuario, $password);
			}
		catch (PDOException $e) {
			die("Error al conectar con el SGBD o la BD no existe. No puedo continuar ...");
		}
	}


	/* Esta función es solo para el uso dentro de la clase, devuelve true si la tabla existe y false si la 
	tabla no existe */

	private function existe($tabla)
	{
		$consulta="show tables like '$tabla'";
		$valor=$this->bd->query($consulta)->fetchColumn();
		if ($valor=="") return false;
		else return true;
	}

	/*  insertar recibe el nombre de una tabla y un array de elementos
	que seran insertados en dicha tabla ordenados en el mismo 
	orden que estan la tabla 
	
	 devuelve true si se ha podido realizar la inserccion
	y false si no ha sido posible */

	public function insertar($tabla,$elementos) {
		if ($this->existe($tabla))
		{
		$cadena="(";
		foreach ($elementos as $dato) {
			$tipo=gettype($dato);
			switch ($tipo) {
				case 'integer':
				case 'double':
					$cadena=$cadena.$dato;
					break;
				default:
					$cadena=$cadena."'".$dato."'";
			}
			$cadena=$cadena.",";
		}
		$cadena= substr($cadena, 0, -1);
		$cadena=$cadena.")";

		$insert="INSERT INTO $tabla VALUES $cadena";
		 if ($this->bd->query($insert)) return true;
		 else return false;
		}
		else return false;
	}

/* Para usar consultarTodos es obligatorio indicar la tabla 
mientras que puedo omitir las condiciones, en caso de utilizar
condiciones debes pasarselas mediante un array */

public function consultarTodos($tablas,$condiciones=[],$parametros=[]) {
	$contador=0;
	foreach ($tablas as $tabla)
	{
		if (!($this->existe($tabla))) $contador++;
	}

	if ($contador==0)
	{
	$tables="";
	foreach ($tablas as $tabla)
	{
		$tables=$tables.$tabla.", ";
	}
	$tables=substr($tables,0,-2);


	if (count($parametros)==0)
	{
		$consulta="SELECT * FROM $tables WHERE ";
	}
	else
	{
		$campo="";
		foreach ($parametros as $param) {
			$campo=$campo.$param.", " ;
		}
		$campo=substr($campo,0,-2);
		$consulta="SELECT $campo FROM $tables WHERE ";

	}

	if (count($condiciones)==0)
	{
	$consulta=substr($consulta,0,-6);	
	}
	else {
	foreach ($condiciones as $dato) {
		$consulta=$consulta.$dato." AND ";
		
	}
		$consulta=substr($consulta,0,-5);	
	}
	//echo $consulta;
	try {
	$resultado=$this->bd->query($consulta)->fetchAll();
		} catch (PDOException $e) {
		return [];
	}
	return $resultado;
}
else return [];
}

/* Para usar borrar es obligatorio indicar la tabla 
mientras que puedo omitir las condiciones, en caso de utilizar
condiciones debes pasarselas mediante un array */

public function borrar($tabla,$condiciones=[]) {
	if ($this->existe($tabla))  {
	$consulta="DELETE FROM $tabla WHERE ";

	if (count($condiciones)==0)
	{
	$consulta=substr($consulta,0,-6);	
	}
	else {
	foreach ($condiciones as $dato) 
		{ $consulta=$consulta.$dato." AND ";}
	
	$consulta=substr($consulta,0,-5);	
	}
	if ($this->bd->query($consulta)) return true;
	else return false; 
	} else return false;
}

/* Para usar consultarTodos es obligatorio indicar la tabla 
mientras que puedo omitir las condiciones, en caso de utilizar
condiciones debes pasarselas mediante un array, el resultado devuelto
por esta funcion será un array unidimensional */

public function contar($tabla,$condiciones=[]) {
	if ($this->existe($tabla))  {
return $this->consultaUno($tabla,$condiciones,"COUNT(*)");
} else return false;
}

/* Para usar consultarTodos es obligatorio indicar la tabla 
mientras que puedo omitir las condiciones, en caso de utilizar
condiciones debes pasarselas mediante un array, el resultado devuelto
por esta funcion será un array unidimensional */

public function consultaRegistro($tabla,$condiciones=[]) {
	if ($this->existe($tabla))  {
	$consulta="SELECT * FROM $tabla WHERE ";

	if (count($condiciones)==0)
	{
	$consulta=substr($consulta,0,-6);	
	}
	else {
	foreach ($condiciones as $dato) {
		$consulta=$consulta.$dato." AND ";
		
	}
		$consulta=substr($consulta,0,-5);	
	}
	try {
	$resultado=$this->bd->query($consulta)->fetch();
	} catch (PDOException $e) {
		return [];
	}
	return $resultado;
} else return [];
}

/* Para usar consultarUno es obligatorio indicar la tabla 
mientras que puedo omitir las condiciones, en caso de utilizar
condiciones debes pasarselas mediante un array, el resultado devuelto
por esta funcion será un valor unitario */

public function consultaUno($tabla,$condiciones=[],$valordevuelto="*") {
	if ($this->existe($tabla))  {
	$consulta="SELECT $valordevuelto FROM $tabla WHERE ";

	if (count($condiciones)==0)
	{
	$consulta=substr($consulta,0,-6);	
	}
	else {
	foreach ($condiciones as $dato) {
		$consulta=$consulta.$dato." AND ";
		
	}
		$consulta=substr($consulta,0,-5);	
	}
	try {
	$resultado=$this->bd->query($consulta)->fetchColumn();
	} catch (PDOException $e) {
		return false;
	}
	return $resultado;
}
else return false;
}

}
 ?>