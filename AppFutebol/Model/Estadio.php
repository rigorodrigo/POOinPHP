<?php

namespace Model;

use Model\Clube;

class Estadio
{

    use TraitId;
    private $id;
    private $nome;
    private $pais;
    private $clubeMandante;


    public function __construct($pais, $nome)
    {
        $this->setId();
        $this->clubeMandante = new \ArrayObject();
        $this->pais = $pais;
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function getClubeMandante()
    {
        return $this->clubeMandante;
    }

    public function setClubeMandante( Clube $clubeMandante)
    {
        $this->clubeMandante->append($clubeMandante);        // um array de objetos pq um estádio pode ter mais de um mandante
        $clubeMandante->setEstadio($this);                   // (Ex: Maracanã, com Flamengo e Fluminense)
    }

    public function removerClubeMandante(Clube $clubeMandante){
        foreach ($this->clubeMandante as $index => $c){
            if($c->getId() == $clubeMandante->getId()){
                unset($this->clubeMandante[$index]);
            }
        }
    }
}