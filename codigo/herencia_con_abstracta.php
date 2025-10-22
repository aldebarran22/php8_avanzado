<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 
	
   ini_set ('error_reporting', E_ALL);

	//////////////////////////////////////////////////////////////////////////////
  class Persona {
	private string $dni;
	private string $nombre;
	private string $apellidos;

	function __construct(string $dni, string $nombre, string $apellidos){
	  $this->nombre=$nombre;
	  $this->apellidos=$apellidos;
      $this->dni=$dni;
	}

	function __toString():string{
	  return $this->nombre . ", " . $this->apellidos . " " . $this->dni;
	}
  }

	//////////////////////////////////////////////////////////////////////////////
  class PersonalExterno extends Persona {
	private string $empresa;

	function __construct(string $dni, string $nombre, string $apellidos, string $empresa){
	  parent::__construct($dni, $nombre, $apellidos);
      $this->empresa=$empresa;		
	}

	function __toString(){
	  return parent::__toString() . ", " . $this->empresa;
	}
  }

	//////////////////////////////////////////////////////////////////////////////
  abstract class Empleado extends Persona {
    protected float $sueldo;
	
	function __construct(string $dni, string $nombre, string $apellidos, float $sueldo){
	  parent::__construct($dni, $nombre, $apellidos);
	  $this->sueldo=$sueldo;
	}
	
	function __toString():string{
	  return parent::__toString() . ", " . $this->sueldo;
	}
	
	abstract function getSueldo(): float;
  }

	//////////////////////////////////////////////////////////////////////////////
   class Ingeniero extends Empleado {
  	private float $extra1;
	private float $extra2;
	
		function __construct(string $dni, string $nombre, string $apellidos, float $sueldo, float $extra1, float $extra2){
		  parent::__construct($dni, $nombre, $apellidos,$sueldo);
		  $this->extra1=$extra1;
		  $this->extra2=$extra2;
		}
		
		function __toString(): string{
		  return parent::__toString() . ", " . $this->extra1 . ", " . $this->extra2;
		}
		
		function getSueldo(): float {
			return $this->sueldo + $this->extra1 + $this->extra2;
		}
	}	
	//////////////////////////////////////////////////////////////////////////////
	class JefeProyecto extends Empleado {
	 private float $incentivos;
	 
		 function __construct(string $dni, string $nombre, string $apellidos, float $sueldo, float $incentivos){
		  parent::__construct($dni, $nombre, $apellidos,$sueldo);
		  $this->incentivos=$incentivos;
		}
		
		function __toString(): string{
		  return parent::__toString() . ", " . $this->incentivos;
		}
		
		function getSueldo() : float {
			return $this->sueldo + $this->incentivos;
		}
	}
  // Principal:


  $persona1 = new Persona('a1','aaaa','bbbb');
  echo "Datos de una persona: " . $persona1 . "<br />";

  $externo1 = new PersonalExterno('a1','aaa','aaa','empresa1');
  echo "Datos de una persona externa: " . $externo1 . "<br />";
  
  $todos = array();
  $todos[0]=new JefeProyecto('a1','aaa','aaa', 1200, 350);
  $todos[1]=new Ingeniero('a1','aaa','aaa', 1200, 350, 600);
  
  for ($i=0; $i < count($todos) ; $i++){
  	echo "DATOS: " . $todos[$i] . " sueldo: " . $todos[$i]->getSueldo() . "<br />";
  }
?>
</body>
</html>