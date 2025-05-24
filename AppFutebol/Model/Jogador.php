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
    // inicializando as stats como zero
    private $partidas = 0;
    private $gols = 0;
    private $assistencias = 0;
    private $cartoesAmarelos = 0;
    private $cartoesVermelhos = 0;

    public function __construct($nome, \DateTime $nascimento, $nacionalidade,$posicao,$peDominante,
                                $altura,$peso,$partidas,$gols,$assistencias,$cartoesAmarelos,
                                $cartoesVermelhos,$clube = null)
    {
        parent::__construct($nome, $nascimento, $nacionalidade);
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

    public function getAssistencias(){
        return $this->assistencias;
    }

    public function getCartoesAmarelos()
    {
        return $this->cartoesAmarelos;
    }

    public function getCartoesVermelhos()
    {
        return $this->cartoesVermelhos;
    }

    public function marcarGol(){
        $this->gols += 1;
    }

    public function darAssistencia(){
        $this->assistencias += 1;
    }

    public function tomarCartaoAmarelo (){
        $this->cartoesAmarelos += 1;
    }

    public function tomarCartaoVermelho (){
        $this->cartoesVermelhos += 1;
    }
}