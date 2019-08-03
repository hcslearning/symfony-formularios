<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Embeddable\Rut;
use App\Validator as HcsAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClienteRepository")
 */
class Cliente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellido;

    /**
     * @HcsAssert\RutValido
     * @ORM\Embedded(class="App\Entity\Embeddable\Rut")
     */
    private $rut;
    
    function __construct() {
        $this->rut = new Rut();
    }

        public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getRut(): ?Rut
    {
        return $this->rut;
    }

    public function setRut(Rut $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function __toString() {
        return $this->nombre.' '.$this->apellido;
    }

}
