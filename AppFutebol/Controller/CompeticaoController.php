<?php

namespace Controller;

use ArrayObject;
use Model\Competicao;
use Model\Clube;
use Exception;

class CompeticaoController
{
    private ArrayObject $competicoes;   // Armazena todas as competições instanciadas

    public function __construct()
    {
        $this->competicoes = new ArrayObject();
    }

    public function criarCompeticao($nome, $numClubes, $pais, $tipo) : Competicao
    {
        if ($this->buscarCompeticao($nome) != null){
            throw new Exception("A competição {$nome} já existe!");
        }
        $competicao = new Competicao($nome, $numClubes, $pais, $tipo);
        $this->competicoes->append($competicao);
        return $competicao;
    }


    public function listarCompeticoes() : ArrayObject
    {
        return $this->competicoes;
    }

    public function adicionarClubeCompeticao(Competicao $competicao, Clube $clube) : void {
        $competicao->adicionarClube($clube);
    }

    public function removerClubeCompeticao(Competicao $competicao, Clube $clube) : void{
        $competicao->removerClube($clube);
    }

    public function buscarCompeticao (string $nome) :? Competicao{
        foreach ($this->competicoes as $competicao) {
            if (strcasecmp($competicao->getNome(), $nome) === 0) {
                return $competicao;
            }
        }
        return null;
    }

    public function buscarCompeticaoPorId (int $id) :? Competicao{
        foreach ($this->listarCompeticoes()as $competicao) {
            if ($competicao->getId() === $id) {
                return $competicao;
            }
        }
        return null;
    }

    public function mostrarTabela (Competicao $competicao) : string
    {
        $tabela = $competicao->getTabelaPontos();

        if (empty($tabela)) {
            return '<div class="alert alert-warning">Não há clubes cadastrados nesta competição.</div>';
        }

        $dados = [];
        foreach ($tabela as $nome => $estatisticas) {
            $dados[] = [
                'nome' => $nome,
                'pontos' => $estatisticas['pontos'],
                'vitorias' => $estatisticas['vitorias'],
                'empates' => $estatisticas['empates'],
                'derrotas' => $estatisticas['derrotas'],
                'gols_pro' => $estatisticas['gols_pro'],
                'gols_contra' => $estatisticas['gols_contra'],
                'saldo' => $estatisticas['gols_pro'] - $estatisticas['gols_contra']
            ];
        }

        usort($dados, function ($a, $b) {
            if ($a['pontos'] === $b['pontos']) {
                if ($a['saldo'] === $b['saldo']) return 0;
                return ($a['saldo'] > $b['saldo']) ? -1 : 1;
            }
            return ($a['pontos'] > $b['pontos']) ? -1 : 1;
        });

        $html = '<div class="tabela-competicao">';
        $html .= '<h3>Tabela da Competição: ' . htmlspecialchars($competicao->getNome()) . '</h3>';
        $html .= '<table>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Pos</th>';
        $html .= '<th>Clube</th>';
        $html .= '<th>Pts</th>';
        $html .= '<th>V</th>';
        $html .= '<th>E</th>';
        $html .= '<th>D</th>';
        $html .= '<th>GP</th>';
        $html .= '<th>GC</th>';
        $html .= '<th>SG</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $pos = 1;
        foreach ($dados as $d) {
            $html .= '<tr>';
            $html .= '<td>' . $pos++ . '</td>';
            $html .= '<td>' . htmlspecialchars($d['nome']) . '</td>';
            $html .= '<td>' . $d['pontos'] . '</td>';
            $html .= '<td>' . $d['vitorias'] . '</td>';
            $html .= '<td>' . $d['empates'] . '</td>';
            $html .= '<td>' . $d['derrotas'] . '</td>';
            $html .= '<td>' . $d['gols_pro'] . '</td>';
            $html .= '<td>' . $d['gols_contra'] . '</td>';
            $html .= '<td>' . ($d['saldo'] >= 0 ? '+' : '') . $d['saldo'] . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';

        return $html;
    }

}
