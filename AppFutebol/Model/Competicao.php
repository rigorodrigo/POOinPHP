<?php

namespace Model;

use ArrayObject;
use model\Clube;

class Competicao
{

    use TraitId;
    private $id;
    private $nome;
    private $numClubes;
    private $pais;
    private $tipo;
    private $tabela;

    public function __construct($nome, $numClubes, $pais,$tipo)
    {
        $this->setId();
        $this->nome = $nome;
        $this->numClubes = $numClubes;
        $this->pais = $pais;
        $this->tipo = $tipo;
        $this->tabela = new  ArrayObject();
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNumClubes()
    {
        return $this->numClubes;
    }

    public function setNumClubes($numClubes)
    {
        $this->numClubes = $numClubes;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function getTabela()
    {
        return $this->tabela;
    }

    public function adicionarClube (Clube $clube){
        $this->tabela->append($clube);
    }

    public function removerClube (Clube $clube){
        foreach ($this->tabela as $index => $c) {   // pegando o index do clube no vetor para remove-lo
            if ($c->getId() == $clube->getId()){
                $this->tabela->offsetUnset($index);
                break;
            }
        }
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    // método para verificar se o clube está na competição

    public function temClube(Clube $clube){
        foreach ($this->getTabela() as $c){
            if($c->getId() == $clube->getId()) {
                return true;
            }
        }
        return false;
    }

}