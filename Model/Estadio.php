<?php

namespace Model;

use Model\Clube;

class Estadio
{

    private $id;
    private $nome;
    private $pais;
    private $clubeMandante;

    private static $contador = 0;

    public function __construct($clubeMandante, $pais, $nome)
    {
        $this->id = self::$contador++;
        $this->clubeMandante = $clubeMandante;
        $this->pais = $pais;
        $this->nome = $nome;
    }

    public function getId(){
        return $this->id;
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
        $this->clubeMandante = $clubeMandante;
        $clubeMandante->setEstadio($this);
    }




}