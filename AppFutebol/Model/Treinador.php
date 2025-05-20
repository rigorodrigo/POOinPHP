<?php

namespace Model;

use Model\Pessoa;
use Model\Clube;

class Treinador extends Pessoa
{

    private $clube;
    private $partidas;
    private $vitorias;
    private $derrotas;
    private $empates;

    public function __construct($nome,$nacionalidade,\DateTime $nascimento,$partidas,$vitorias,$derrotas,$empates, Clube $clube = null)
    {
        parent::__construct($nome, $nascimento, $nacionalidade);
        $this->partidas = $partidas;
        $this->vitorias = $vitorias;
        $this->derrotas = $derrotas;
        $this->empates = $empates;
        $this->clube = $clube;
    }

    public function getClube()
    {
        return $this->clube;
    }

    public function setClube (Clube $clube){
        $this->clube = $clube;
        $clube->setTreinador($this);
    }

    public function getPartidas()
    {
        return $this->partidas;
    }

    public function setPartidas($partidas)
    {
        $this->partidas = $partidas;
    }

    public function getVitorias()
    {
        return $this->vitorias;
    }

    public function setVitorias($vitorias)
    {
        $this->vitorias = $vitorias;
    }

    public function getDerrotas()
    {
        return $this->derrotas;
    }

    public function setDerrotas($derrotas)
    {
        $this->derrotas = $derrotas;
    }

    public function getEmpates()
    {
        return $this->empates;
    }

    public function setEmpates($empates)
    {
        $this->empates = $empates;
    }


}