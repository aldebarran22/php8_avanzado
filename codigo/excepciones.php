<?php

class ExceptionPersona extends Exception {
	
		// Podemos mmodificar el comportamiento del método __toString() y le hacemos que devuelva sólo el mensaje asociado a la
		// exception, en caso contrario devuelve código, mensaje, el nombre del fichero y la linea.
		
		function __toString(): string{
			return $this->getMessage();	
		}
	}

class Persona {
	private string $dni;
	private string $nombre;
	private string $apellidos;
    private int $edad;

	function __construct(string $dni="", string $nombre="", string $apellidos="", int $edad=0){
	  $this->nombre=$nombre;
	  $this->apellidos=$apellidos;
      $this->dni=$dni;
      $this->edad=$edad;
	}

    function getNombreClase(){
		return get_class();
	}
	
	public function getNombre(): string{
		return $this->nombre;
	}
	
	public function setNombre(string $nuevoNombre):void {
		$this->nombre = $nuevoNombre;
	}
	
	public function getApellidos(): string {
		return $this->apellidos;
	}
	
	public function setApellidos(string $nuevoApellido): void{
		$this->apellidos = $nuevoApellido;
	}
	
	public function getDni(): string{
		return $this->dni;
	}
	
	public function setDni(string $nuevoDni): void{
		$this->dni = $nuevoDni;
	}
	
	public function getEdad(): int{
		return $this->edad;
	}
	
	public function setEdad(int $nuevaEdad): void{
		// Este método controla que la edad de la persona no sea un número negativo:
		
		if ($nuevaEdad < 0){ // Le mandamos al contructor un mensaje y un código de error: 
			throw new ExceptionPersona("La edad de la persona no puede ser negativa",1);
			$this->edad = 0;
		} else
			$this->edad = $nuevaEdad;
	}

	function __toString():string{
	  return $this->nombre . ", " . $this->apellidos . " " . $this->dni;
	}
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    	$p = new Persona();
        $p2 = new Persona("Antonio", "Perez", "111111", 20);

        echo "p = $p<br />";
        echo "p2 = $p2<br />";
        echo "nombre clase de p: " . $p->getNombreClase() . "<br />";
        echo var_dump($p2) . "<br />";
        
        echo "nombre de la persona p2: " . $p2->getNombre() . "<br/>";
        $p2->setNombre("Pepe");
        echo "nuevo nombre de la persona p2: " . $p2->getNombre() . "<br/>";
        
        $p2->setApellidos("Sanchez");
        
        echo "p2 modificada es $p2<br />";
        
        echo "<br />Prueba de la Exception ...<br/>";
        
        
        try {
            $p2->setEdad(-8);
        } catch (ExceptionPersona $e){
            echo "<br />Se ha producido el siguiente error ... " . $e;
        }
              
        echo "<br/>" . date("d-m-y") . "<br/>";
        echo "<br/>" . date("d-m-Y") . "<br/>";
        echo "<br/>" . date("d-M-Y") . "<br/>";
        echo "<br/>" . date("D-d-m-y") . "<br/>";
    ?>
</body>
</html>