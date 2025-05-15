<?php

namespace Model;
use Model\Jogador;

class Clube
{

    private $nome;
    private $pais;
    private $jogadores = [];

    public function __construct($nome,$pais){
        $this->nome = $nome;
        $this->pais = $pais;
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