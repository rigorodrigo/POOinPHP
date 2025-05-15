<?php
namespace Model;
class Pessoa
{
    private $id;
    private $nome;
    private $idade;
    private $nacionalidade;

    private static $contador = 0;

    public function __construct($nome,$idade,$nacionalidade){

        $this->id = self::$contador++;    // gerando id automático de acordo com o contador
        $this->nome = $nome;
        $this->idade = $idade;
        $this->nacionalidade = $nacionalidade;
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