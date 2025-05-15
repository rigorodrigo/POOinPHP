<?php
namespace Model;
class Pessoa
{
    private $nome;
    private $idade;
    private $nacionalidade;

    public function __construct($nome,$idade,$nacionalidade){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->nacionalidade = $nacionalidade;
    }

    public function getNome(){
    return $this->nome;
    }

    public function setNome($nome){
    $this->nome = $nome;
    }

     public function getIdade(){
    return $this->idade;
    }

    public function setIdade($idade){
    $this->idade = $idade;
    }

    public function getNacionalidade(){
        return $this->nacionalidade;
    }


    public function setNacionalidade($nacionalidade)
    {
        $this->nacionalidade = $nacionalidade;
    }
}