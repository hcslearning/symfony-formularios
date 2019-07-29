<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DespachoRepository")
 */
class Despacho
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=5)
     * @ORM\Column(type="string", length=255)
     */
    private $nombreCompleto;

    

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $direccion;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $comuna;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=10)
     */
    private $telefono;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\GreaterThanOrEqual(1000000)
     * @ORM\Column(type="integer")
     */
    private $rut;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=1)
     */
    private $dv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreCompleto(): ?string
    {
        return $this->nombreCompleto;
    }

    public function setNombreCompleto(string $nombreCompleto): self
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }    

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getComuna(): ?string
    {
        return $this->comuna;
    }

    public function setComuna(string $comuna): self
    {
        $this->comuna = $comuna;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRut(): ?int
    {
        return $this->rut;
    }

    public function setRut(int $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getDv(): ?string
    {
        return $this->dv;
    }

    public function setDv(string $dv): self
    {
        $this->dv = $dv;

        return $this;
    }
}
