<?php

namespace Model;

use ArrayObject;

class Competicao
{

    private $id;
    private $nome;
    private $numClubes;
    private $pais;
    private $clubes;
    private $tipo;
    private $tabela = [];

    /**
     * @param $nome
     * @param $numClubes
     * @param $pais
     * @param $clubes
     * @param $tipo
     */
    public function __construct($nome, $numClubes, $pais,$tipo)
    {
        $this->nome = $nome;
        $this->numClubes = $numClubes;
        $this->pais = $pais;
        $this->clubes = new ArrayObject();
        $this->tipo = $tipo;
    }


}