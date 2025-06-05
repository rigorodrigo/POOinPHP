<?php

namespace Model;

use LogicException;
use Model\Pessoa;
use Model\Clube;

class Jogador extends Pessoa
{

    private  Clube $clube;
    private string $posicao;
    private string $peDominante;
    private float $altura;
    private float $peso;
    // inicializando as stats como zero
    private int $partidas = 0;
    private int $gols = 0;
    private int $assistencias = 0;
    private int $cartoesAmarelos = 0;
    private int $cartoesVermelhos = 0;

    public function __construct($nome, \DateTime $nascimento, $nacionalidade,$posicao, $peDominante, $altura, $peso)
    {
        parent::__construct($nome, $nascimento, $nacionalidade);
        $this->posicao = $posicao;
        $this->peDominante = $peDominante;
        $this->altura = $altura;
        $this->peso = $peso;
    }

    public function getClube() : Clube{
        return $this->clube;
    }

    public function setClube( Clube $clube): void{
        $this->clube = $clube;
    }

    public function getPosicao() : string{
        return $this->posicao;
    }

    public function setPosicao($posicao) : void{
        $this->posicao = $posicao;
    }

    public function getPeDominante() : string{
        return $this->peDominante;
    }

    public function setPeDominante($peDominante) : void{
        $this->peDominante = $peDominante;
    }

    public function getAltura() : float{
        return $this->altura;
    }

    public function setAltura($altura) : void{
        $this->altura = $altura;
    }

    public function getPeso() : float{
        return $this->peso;
    }

    public function setPeso($peso) : void{
        $this->peso = $peso;
    }


    public function getPartidas() : int{
        return $this->partidas;
    }

    public function getGols() : int{
        return $this->gols;
    }

    public function getAssistencias() : int{
        return $this->assistencias;
    }

    public function getCartoesAmarelos() : int
    {
        return $this->cartoesAmarelos;
    }

    public function getCartoesVermelhos() : int
    {
        return $this->cartoesVermelhos;
    }

    public function jogarPartida() : void{
        $this->partidas += 1;
    }

    public function marcarGol() : void{
        $this->gols += 1;
    }

    public function darAssistencia() : void{
        $this->assistencias += 1;
    }

    public function tomarCartaoAmarelo () : void{
        $this->cartoesAmarelos += 1;
    }

    public function tomarCartaoVermelho () : void{
        $this->cartoesVermelhos += 1;
    }

    public function transferirPara(Clube $clubeDestino)  : void {
        if ($this->clube && $this->clube->getId() === $clubeDestino->getId()) {
            throw new LogicException("Jogador já está no clube!");
        }
        $this->clube->removerJogador($this);
        $clubeDestino->adicionarJogador($this);
    }

    public function calcularMediaGols() : float{
        if ($this->partidas ==0 ){
            return 0.0;
        }
        return $this->gols / $this->partidas;
    }
}