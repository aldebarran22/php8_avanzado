<?php

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
?>