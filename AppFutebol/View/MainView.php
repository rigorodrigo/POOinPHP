<?php

namespace View;

use Model\Clube;
use Model\Competicao;
use Model\Jogador;
use Model\Partida;
use Controller\PartidaController;
use Controller\CompeticaoController;
use Controller\JogadorController;

class MainView
{
    private $partidaController;
    private $competicaoController;
    private $jogadorController;

    public function __construct()
    {
        $this->partidaController = new PartidaController();
        $this->competicaoController = new CompeticaoController();
        $this->jogadorController = new JogadorController();
    }

    public function exibirMenu()
    {
        echo "=== App de Futebol ===\n";
        echo "1. Adicionar resultado de partida\n";
        echo "2. Visualizar tabela de competição\n";
        echo "3. Visualizar estatísticas de jogadores\n";
        echo "4. Sair\n";
        echo "Escolha uma opção: ";
        $opcao = trim(fgets(STDIN));
        
        switch ($opcao) {
            case '1':
                echo "Digite o nome dos dois clubes:\n";
                $clubeCasa = trim(fgets(STDIN));
                $clubeVisitante = trim(fgets(STDIN));
                echo "Digite a data da partida: \n";
                $data = trim(fgets(STDIN));
                $data = new \DateTime($data);
                $this->partidaController->criarPartida($clubeCasa,$clubeVisitante,$data);
                break;
            case '2':
                echo "Veja as competições disponíveis: \n";
                echo $this->competicaoController->listarCompeticoes();
                echo "\n";
                echo "Digite o nome da competição que você deseja ver a tabela: \n";
                $competicao = trim(fgets(STDIN));
                $this->competicaoController->visualizarTabelaCompeticao($competicao);
                break;
            case '3':
                echo "Digite o nome do jogador que você deseja ver as estatísticas: \n";
                $jogador = trim(fgets(STDIN));
                $this->jogadorController->visualizarEstatisticasJogador($jogador);
                break;
            case '4':
                echo "Saindo...\n";
                exit;
            default:
                echo "Opção inválida!\n";
                $this->exibirMenu();
        }
    }

}