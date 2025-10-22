<?php

  class Persona {
	protected string $dni;
	protected string $nombre;
	protected string $apellidos;

	function __construct(string $dni, string $nombre, string $apellidos){
	  $this->nombre=$nombre;
	  $this->apellidos=$apellidos;
      $this->dni=$dni;
	}

   

	function __toString():string{
	  return $this->nombre . ", " . $this->apellidos . " " . $this->dni;
	}
  }

  class Empleado extends Persona {

    private string $empresa;
    private float $sueldo;

    public function __construct(string $dni, string $nombre, 
    string $apellidos, string $empresa, float $sueldo){
        // Llamar al constructor de la clase Padre:
        parent::__construct($dni, $nombre, $apellidos);

        // Almacenar los att de la clase:
        $this->empresa = $empresa;
        $this->sueldo = $sueldo;
    }

    function modificarDni($dni){
        $this->dni = $dni;
    }

    function __toString():string{
        return parent::__toString() . " " . $this->empresa . " " . $this->sueldo;
    }
  }

  // Crear un empleado:
  $emp = new Empleado("1234567D","Jorge", "Sanz", "TRT", 2000.0);
  echo $emp . "<br>";
  //$emp->dni = "34343434Y";
  $emp->modificarDni("22334455H");
  echo $emp . "<br>";
?>