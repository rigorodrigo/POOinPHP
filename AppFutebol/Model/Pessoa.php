<?php
namespace Model;

use DateTime;

abstract  class Pessoa {
    use TraitId;
    private string $nome;
    private DateTime $nascimento;
    private string $nacionalidade;


    public function __construct($nome, DateTime $nascimento, $nacionalidade)
    {
        $this->setId($nome);
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->nacionalidade = $nacionalidade;
    }

    public function getNome() : string{
    return $this->nome;
    }

    public function setNome($nome) : void{
    $this->nome = $nome;
    }

    public function getNascimento() : DateTime
    {
        return $this->nascimento;
    }

    public function setNascimento(DateTime $nascimento) : void
    {
        $this->nascimento = $nascimento;
        $this->getIdade();
    }

    public function getNacionalidade() : string{
        return $this->nacionalidade;
    }

    public function setNacionalidade($nacionalidade) : void
    {
        $this->nacionalidade = $nacionalidade;
    }

    public function getIdade() : int {
        $hoje = new DateTime();
        $idade = $this->nascimento->diff($hoje)->y;       // y converte para anos a diferença da subtração
        return $idade;
    }
}