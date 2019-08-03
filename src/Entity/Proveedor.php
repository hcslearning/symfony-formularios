<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProveedorRepository")
 */
class Proveedor
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
    private $razonSocial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sucursal", mappedBy="proveedor", orphanRemoval=true, cascade={"persist"})
     */
    private $sucursales;

    public function __construct()
    {
        $this->sucursales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRazonSocial(): ?string
    {
        return $this->razonSocial;
    }

    public function setRazonSocial(string $razonSocial): self
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return Collection|Sucursal[]
     */
    public function getSucursales(): Collection
    {
        return $this->sucursales;
    }

    public function addSucursale(Sucursal $sucursale): self
    {
        if (!$this->sucursales->contains($sucursale)) {
            $this->sucursales[] = $sucursale;
            $sucursale->setProveedor($this);
        }

        return $this;
    }

    public function removeSucursale(Sucursal $sucursale): self
    {
        if ($this->sucursales->contains($sucursale)) {
            $this->sucursales->removeElement($sucursale);
            // set the owning side to null (unless already changed)
            if ($sucursale->getProveedor() === $this) {
                $sucursale->setProveedor(null);
            }
        }

        return $this;
    }
}
