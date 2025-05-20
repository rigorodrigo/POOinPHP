<?php

namespace Model;
use Model\Jogador;
use Model\Estadio;
use Model\Treinador;

class Clube
{

    use TraitId;
    private  $id;
    private $nome;
    private $pais;
    private $jogadores;
    private $treinador;
    private $estadio;

    public function __construct($nome,$pais, Estadio $estadio,Treinador $treinador){

        $this->setId();
        $this->nome = $nome;
        $this->pais = $pais;
        $this->estadio = $estadio;
        $this->jogadores = new \ArrayObject();
        $this->treinador = $treinador;
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
        $estadio->setClubeMandante($this);
    }

    public function getTreinador()
    {
        return $this->treinador;
    }

    public function setTreinador(Treinador $treinador){
        $this->treinador = $treinador;
        $treinador->setClube($this);
    }

    public function adicionarJogador (Jogador $jogador) {
        $this->jogadores->append($jogador);
        $jogador->setClube($this);
    }

    public function removerJogador (Jogador $jogador){
        foreach ($this->jogadores as $index => $j) {
            if($j->getId() == $jogador->getId()){
                $this->jogadores->offsetUnset($index);
            }
        }
        $jogador->setClube(null);
    }

    public function getJogadores()
    {
        return $this->jogadores;
    }


}