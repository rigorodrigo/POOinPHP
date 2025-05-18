<?php
namespace Model;

use DateTime;

abstract  class Pessoa {
    use TraitId;
    private $id;
    private $nome;
    private $nascimento;
    private $nacionalidade;


    public function __construct($nome, \DateTime $nascimento, $nacionalidade)
    {
        $this->setId();
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->nacionalidade = $nacionalidade;
    }

    public function getNome(){
    return $this->nome;
    }

    public function setNome($nome){
    $this->nome = $nome;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function setNascimento(\DateTime $nascimento)
    {
        $this->nascimento = $nascimento;
        $this->getIdade();
    }

    public function getNacionalidade(){
        return $this->nacionalidade;
    }

    public function setNacionalidade($nacionalidade)
    {
        $this->nacionalidade = $nacionalidade;
    }

    public function getIdade() {
        $hoje = new DateTime();
        $idade = $this->nascimento->diff($hoje)->y;       // y converte para anos a diferença da subtração
        return $idade;
    }
}