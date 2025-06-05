<?php

namespace Model;

use ArrayObject;
use LogicException;


class Estadio
{

    use TraitId;

    private int  $id;
    private string $nome;
    private string $pais;
    private ArrayObject $clubeMandante;

// não deixei obrigatório colocar clube mandante no estádio, pois há estádios que não possuem clubes mandantes. Ex: Wembley,Mané Garrincha,etc.

    public function __construct($pais, $nome)
    {
        $this->setId($nome);
        $this->clubeMandante = new ArrayObject();
        $this->pais = $pais;
        $this->nome = $nome;
    }

    public function getNome() :string
    {
        return $this->nome;
    }

    public function setNome($nome) :void
    {
        $this->nome = $nome;
    }

    public function getPais() : string
    {
        return $this->pais;
    }

    public function setPais($pais) : void
    {
        $this->pais = $pais;
    }

    public function getClubeMandante() : ArrayObject
    {
        return $this->clubeMandante;
    }

    private function contemClube(Clube $clube) : bool
    {
        foreach ($this->clubeMandante as $c) {
            if ($c->getId() === $clube->getId()) {
                return true;
            }
        }
        return false;
    }

    public function adicionarMandante(Clube $clube) : void
    {
        if ($this->contemClube($clube)) {
            throw new LogicException("Clube já é mandante!");
        }

        $this->clubeMandante->append($clube);
    }

    public function removerMandante(Clube $clube) : void
    {
        if (!$this->contemClube($clube)) {
            throw new LogicException("Clube não é mandante!");
        }

        foreach ($this->clubeMandante as $index => $c) {
            if ($c->getId() === $clube->getId()) {
                $this->clubeMandante->offsetUnset($index);
                break;
            }
        }
    }
}