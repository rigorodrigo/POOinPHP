<?php

namespace Model;
use Model\Jogador;
use Model\Estadio;

class Clube
{

    private  $id;
    private $nome;
    private $pais;
    private $jogadores = [];
    private $estadio;

    private static $contador = 0;

    public function __construct($nome,$pais, Estadio $estadio){
        $this->id = self::$contador++;
        $this->nome = $nome;
        $this->pais = $pais;
        $this->estadio = $estadio;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
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

    public function getEstadio()
    {
        return $this->estadio;
    }

    public function setEstadio( Estadio $estadio)
    {
        $this->estadio = $estadio;
    }



    public function adicionarJogador (Jogador $jogador) {
        $this->jogadores[] = $jogador;
        $jogador->setClube($this);
    }

    /*public function removerJogador (Jogador $jogador){
        $this->jogadores->remove($jogador);
        $jogador->setClube(null);
    }*/

    public function getJogadores()
    {
        return $this->jogadores;
    }


}