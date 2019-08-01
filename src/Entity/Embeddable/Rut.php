<?php

namespace App\Entity\Embeddable;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Rut {

    /**
     * @ORM\Column(type="integer")
     */
    private $rut;
    /**
     * @ORM\Column(type="string", length=1, options={"fixed" = true})
     */
    private $dv;

    static function parse(string $rutString): Rut {
        $rutPregReplace = preg_replace('/[^0-9kK]/', '', $rutString);
        $dv = substr($rutPregReplace, -1);
        $rut = substr($rutPregReplace, 0, -1);
        return new Rut(intval($rut), $dv);
    }

    function __construct(int $rut = null, string $dv = null) {
        $this->rut = $rut;
        $this->dv = $dv;
    }

    // HELPERS METHODS
    public function corregirDv(): self
    {
        $dv = $this->calcularDv();
        $this->setDv($dv);
        return $this;
    }
    
    public function isValid(): bool {
        if ($this->calcularDv() == $this->getDv()) {
            return true;
        }
        return false;
    }

    public function calcularDv(): string {
        $rut = intval($this->rut) . "";
        $arrRut = str_split($rut);
        $arrRutRev = array_reverse($arrRut);
        $arrMul = array(2, 3, 4, 5, 6, 7);
        $arrMulCopy = array_merge($arrMul, array());
        $suma = 0;
        foreach ($arrRutRev as $k => $num) {
            if (empty($arrMulCopy)) {
                $arrMulCopy = array_merge($arrMul, array());
            }
            $suma += array_shift($arrMulCopy) * $num;
        }
        $modulo = $suma % 11;
        $resultado = 11 - $modulo;
        if ($resultado == 10) {
            $resultado = "k";
        } elseif ($resultado == 11) {
            $resultado = "0";
        }
        return $resultado;
    }

    // GETTER Y SETTERS

    function getRut() {
        return $this->rut;
    }

    function getDv() {
        return strtolower($this->dv);
    }

    function setRut($rut): self {
        $this->rut = $rut;
        return $this;
    }

    function setDv($dv): self {
        $this->dv = strtolower($dv);
        return $this;
    }

    public function __toString() {
        return $this->getRut().'-'.$this->getDv();
    }

}
