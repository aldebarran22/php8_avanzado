<?php
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
		$this->edad = $nuevaEdad;
	}

	function __toString():string{
	  return $this->nombre . ", " . $this->apellidos . " " . $this->dni . " " . $this->edad;
	}
  }
