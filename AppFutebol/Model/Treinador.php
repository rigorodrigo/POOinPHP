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

    public function __construct($nome,$nacionalidade,\DateTime $nascimento,$vitorias,$derrotas,$empates, Clube $clube = null)
    {
        parent::__construct($nome, $nascimento, $nacionalidade);
        $this->vitorias = $vitorias;
        $this->derrotas = $derrotas;
        $this->empates = $empates;
        $this->partidas = $vitorias + $derrotas + $empates;
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

    // partidas é a soma destes 3, para evitar inconsistências do tipo (mais vitórias do que partidas,etc.)

    public function setPartidas($vitorias,$derrotas,$empates)
    {
        $this->partidas = $vitorias + $derrotas + $empates;
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