<?php

namespace Controller;

use Model\Competicao;
use Model\Clube;
use Model\Partida;

class CompeticaoController
{
    private $competicoes;
    private $tabelasPontos; // Armazena os pontos de cada clube em cada competição

    public function __construct()
    {
        $this->competicoes = new \ArrayObject();
        $this->tabelasPontos = []; // Formato: [competicaoId][clubeId] => [pontos, jogos, vitorias, empates, derrotas, golsPro, golsContra]
    }

    public function criarCompeticao($nome, $numClubes, $pais, $tipo)
    {
        $competicao = new Competicao($nome, $numClubes, $pais, $tipo);
        $this->competicoes->append($competicao);
        $this->tabelasPontos[$competicao->getId()] = [];
        return $competicao;
    }


    public function listarCompeticoes()
    {
        return $this->competicoes;
    }

    public function adicionarClubeCompeticao(Competicao $competicao, Clube $clube){
        if($competicao->temClube($clube)){
            throw new \LogicException("O clube {$clube->getNome()} já pertence a competição!");
        }

        if(count($competicao->getTabela()) >= $competicao->getNumClubes() ){
            throw new \OverflowException("A competição {$competicao->getNome()} já possui o número máximo de clubes!");
        }
        // Adicionando clube a competição
        $competicao->adicionarClube($clube);
        // inicializando o clube na tabela, com todas as estatísticas zeradas
        $this->tabelasPontos[$competicao->getId()][$clube->getId()] = [0, 0, 0, 0, 0, 0, 0];
    }

    public function removerClubeCompeticao(Competicao $competicao, Clube $clube){
        if(!$competicao->temClube($clube)){
            throw new \LogicException("O clube {$clube->getNome()} não pertence a competição!");
        }
        $competicao->removerClube($clube);
        unset($this->tabelasPontos[$competicao->getId()][$clube->getId()]);
    }

    public function visualizarTabelaCompeticao(Competicao $competicao){
        if(!isset($this->tabelasPontos[$competicao->getId()])){
            echo "Competição não encontrada!\n";
            return;
        }

        if(empty($competicao->getTabela())){
            echo "A competição {$competicao->getNome()} ainda não possui clubes!\n";
            return;
        }

        echo "Tabela do(a) {$competicao->getNome()} \n";
        echo "Clube\t\tP\tJ\tV\tE\tD\tGP\tGC\n";
        echo "------------------------------------------------------\n";

        $tabelaOrdenada = [];

        usort($tabelaOrdenada, function($a, $b){
            return $b[1] - $a[1];
        });

        $posicao = 1;


    }

}