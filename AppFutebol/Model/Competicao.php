<?php

namespace Model;

use ArrayObject;
use Exception;
use OverflowException;

class Competicao
{

    use TraitId;
    private int $id;
    private string $nome;
    private int $numClubes;
    private string $pais;
    private string $tipo;  // se é regional,estadual,nacional,continental ou mundial
    private ArrayObject $clubes;
    private array $tabelaPontos = [];

    public function __construct($nome, $numClubes, $pais,$tipo)
    {
        $this->setId($nome);
        $this->nome = $nome;
        $this->numClubes = $numClubes;
        $this->pais = $pais;
        $this->tipo = $tipo;
        $this->clubes = new  ArrayObject();
    }

    public function getNome() : string
    {
        return $this->nome;
    }

    public function setNome($nome) : void
    {
        $this->nome = $nome;
    }

    public function getNumClubes() : int
    {
        return $this->numClubes;
    }

    public function setNumClubes($numClubes) : void
    {
        $this->numClubes = $numClubes;
    }

    public function getPais() : string
    {
        return $this->pais;
    }

    public function setPais($pais) : void
    {
        $this->pais = $pais;
    }

    public function getClubes() : ArrayObject
    {
        return $this->clubes;
    }


    public function getTipo() : string
    {
        return $this->tipo;
    }

    public function setTipo($tipo) : void
    {
        $this->tipo = $tipo;
    }

    public function getTabelaPontos() : array
    {
        return $this->tabelaPontos;
    }

    public function temClube(Clube $clube) :bool {
        foreach ($this->getClubes() as $c){
            if(strcasecmp($c->getNome(), $clube->getNome()) === 0) {
                return true;
            }
        }
        return false;
    }

    public function adicionarClube(Clube $clube) : void {
        if ($this->temClube($clube)) {
            throw new Exception("Clube {$clube->getNome()} já está na competição!");
        }
        if (count($this->clubes) >= $this->numClubes) {
            throw new OverflowException("Número máximo de clubes atingido!");
        }
        $this->clubes[] = $clube;
        $this->tabelaPontos[$clube->getNome()] = [
            'pontos' => 0,
            'vitorias' => 0,
            'empates' => 0,
            'derrotas' => 0,
            'gols_pro' => 0,
            'gols_contra' => 0
        ];
    }

    public function removerClube (Clube $clube) : void{
        if ($this->temClube($clube) === false) throw new Exception("O clube {$clube->getNome()} não pertence a competição!");

        foreach ($this->clubes as $index => $c) {   // pegando o index do clube no vetor para remove-lo
            if(strcasecmp($c->getNome(), $clube->getNome()) === 0){
                $this->clubes->offsetUnset($index);
                break;
            }
        }
        unset($this->tabelaPontos[$clube->getNome()]);
    }


    public function registrarResultado(Partida $partida) : void {
        $clubeCasa = $partida->getClubeCasa();
        $clubeVisitante = $partida->getClubeVisitante();
        $golsCasa = $partida->getGolsCasa();
        $golsVisitante = $partida->getGolsVisitante();

        // Validação usando o nome do clube
        if (!$this->temClube($clubeCasa)) {
            throw new Exception("Clube mandante ({$clubeCasa->getNome()}) não está na competição!");
        }
        if (!$this->temClube($clubeVisitante)) {
            throw new Exception("Clube visitante ({$clubeVisitante->getNome()}) não está na competição!");
        }

        if ($clubeCasa->getId() == $clubeVisitante->getId()) {
            throw new Exception("Um clube não pode jogar contra ele mesmo!");
        }

        // Atualiza estatísticas dos clubes
        $this->tabelaPontos[$clubeCasa->getNome()]['gols_pro'] += $golsCasa;
        $this->tabelaPontos[$clubeCasa->getNome()]['gols_contra'] += $golsVisitante;

        $this->tabelaPontos[$clubeVisitante->getNome()]['gols_pro'] += $golsVisitante;
        $this->tabelaPontos[$clubeVisitante->getNome()]['gols_contra'] += $golsCasa;

        // Atualiza pontos, vitórias, empates e derrotas
        if ($golsCasa > $golsVisitante) {
            $this->tabelaPontos[$clubeCasa->getNome()]['pontos'] += 3;
            $this->tabelaPontos[$clubeCasa->getNome()]['vitorias'] += 1;
            $this->tabelaPontos[$clubeVisitante->getNome()]['derrotas'] += 1;
        } elseif ($golsCasa < $golsVisitante) {
            $this->tabelaPontos[$clubeVisitante->getNome()]['pontos'] += 3;
            $this->tabelaPontos[$clubeVisitante->getNome()]['vitorias'] += 1;
            $this->tabelaPontos[$clubeCasa->getNome()]['derrotas'] += 1;
        } else {
            $this->tabelaPontos[$clubeCasa->getNome()]['pontos'] += 1;
            $this->tabelaPontos[$clubeVisitante->getNome()]['pontos'] += 1;
            $this->tabelaPontos[$clubeCasa->getNome()]['empates'] += 1;
            $this->tabelaPontos[$clubeVisitante->getNome()]['empates'] += 1;
        }
    }
}
