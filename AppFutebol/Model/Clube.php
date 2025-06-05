<?php

namespace Model;
use LogicException;
use ArrayObject;

class Clube
{

    use TraitId;
    private int $id;
    private string $nome;
    private string $pais;
    private ArrayObject $jogadores;
    private Estadio $estadio;

    public function __construct($nome,$pais, Estadio $estadio){
        $this->setId($nome);
        $this->nome = $nome;
        $this->pais = $pais;
        $this->estadio = $estadio;
        $this->jogadores = new ArrayObject();
    }

    public function getNome() :string{
        return $this->nome;
    }

    public function setNome($nome) : void{
        $this->nome = $nome;
    }

    public function getPais() : string
    {
        return $this->pais;
    }

    public function setPais($pais) : void
    {
        $this->pais = $pais;
    }

    public function getEstadio() : Estadio
    {
        return $this->estadio;
    }

    public function setEstadio( Estadio $estadio) :void
    {
        $this->estadio = $estadio;
        $estadio->adicionarMandante($this); // já irá adicionar o clube no objeto Estadio
    }

    public function adicionarJogador(Jogador $jogador) :void
    {
        foreach ($this->jogadores as $j){
            if (strcasecmp($j->getNome(), $jogador->getNome()) === 0){
                throw new LogicException("Jogador {$jogador->getNome()} já está no clube!");
            }
        }
        $this->jogadores->append($jogador);
        $jogador->setClube($this);
    }

    public function removerJogador(Jogador $jogador) :void{
        foreach ($this->jogadores as $index => $j){
            if(strcasecmp($j->getNome(), $jogador->getNome()) === 0){
                $this->jogadores->offsetUnset($index);
                return;
            }
        }
        throw new LogicException("Jogador {$jogador->getNome()} não está no clube!");
    }


    public function getJogadores() : ArrayObject
    {
        return $this->jogadores;
    }


}