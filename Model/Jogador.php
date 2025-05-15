<?php

namespace Model;

use Model\Pessoa;
use Model\Clube;

class Jogador extends Pessoa
{

    private $clube;
    private $posicao;
    private $peDominante;
    private $altura;
    private $peso;
    private $partidas;
    private $gols;
    private $assistencias;
    private $cartoesAmarelos;
    private $cartoesVermelhos;

    public function __construct($nome, $idade, $nacionalidade,$posicao,$peDominante,
                                $altura,$peso,$partidas,$gols,$assistencias,$cartoesAmarelos,
                                $cartoesVermelhos,$clube = null)
    {
        parent::__construct($nome, $idade, $nacionalidade);
        $this->clube = $clube;
        $this->posicao = $posicao;
        $this->peDominante = $peDominante;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->partidas = $partidas;
        $this->gols = $gols;
        $this->assistencias = $assistencias;
        $this->cartoesAmarelos = $cartoesAmarelos;
        $this->cartoesVermelhos = $cartoesVermelhos;
    }

    public function getClube(){
        return $this->clube;
    }

    public function setClube( Clube $clube){
        $this->clube = $clube;
    }

    public function getPosicao(){
        return $this->posicao;
    }

    public function setPosicao($posicao){
        $this->posicao = $posicao;
    }

    public function getPeDominante(){
        return $this->peDominante;
    }

    public function setPeDominante($peDominante){
        $this->peDominante = $peDominante;
    }

    public function getAltura(){
        return $this->altura;
    }

    public function setAltura($altura){
        $this->altura = $altura;
    }

    public function getPeso(){
        return $this->peso;
    }

    public function setPeso($peso){
        $this->peso = $peso;
    }

    public function getPartidas(){
        return $this->partidas;
    }

    public function setPartidas($partidas){
        $this->partidas = $partidas;
    }

    public function getGols(){
        return $this->gols;
    }

    public function setGols ($gols){
        $this->gols = $gols;
    }

    public function getAssistencias(){
        return $this->assistencias;
    }

    public function setAssistencias($assistencias)
    {
        $this->assistencias = $assistencias;
    }

    public function getCartoesAmarelos()
    {
        return $this->cartoesAmarelos;
    }

    public function setCartoesAmarelos($cartoesAmarelos)
    {
        $this->cartoesAmarelos = $cartoesAmarelos;
    }

    public function getCartoesVermelhos()
    {
        return $this->cartoesVermelhos;
    }

    public function setCartoesVermelhos($cartoesVermelhos)
    {
        $this->cartoesVermelhos = $cartoesVermelhos;
    }
}