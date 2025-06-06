<?php

namespace View;

use Exception;
use Model\Estadio;
use Model\Partida;

class MainView {
    private $clubeController;
    private $jogadorController;
    private $competicaoController;
    private $estadios;
    private $message = '';

    public function __construct() {
        $this->loadControllersFromSession();
        $this->processFormSubmission();
    }

    private function loadControllersFromSession() {
        $this->clubeController = unserialize($_SESSION['clubeController']);
        $this->jogadorController = unserialize($_SESSION['jogadorController']);
        $this->competicaoController = unserialize($_SESSION['competicaoController']);
        $this->estadios = unserialize($_SESSION['estadios']);
    }

    private function saveControllersToSession() {
        $_SESSION['clubeController'] = serialize($this->clubeController);
        $_SESSION['jogadorController'] = serialize($this->jogadorController);
        $_SESSION['competicaoController'] = serialize($this->competicaoController);
        $_SESSION['estadios'] = serialize($this->estadios);
    }

    private function processFormSubmission() {
        if (!$_POST) return;

        try {
            switch ($_POST['action']) {
                case 'criar_estadio':
                    $this->addEstadio();
                    break;
                case 'criar_clube':
                    $this->addClube();
                    break;
                case 'criar_jogador':
                    $this->addJogador();
                    break;
                case 'criar_competicao':
                    $this->addCompeticao();
                    break;
                case 'adicionar_clube_competicao':
                    $this->addClubeCompeticao();
                    break;
                case 'finalizar_partida':
                    $this->finalizarPartida();
                    break;
            }
            $this->saveControllersToSession();
        } catch (Exception $e) {
            $this->message = "Erro: " . $e->getMessage();
        }
    }

    private function addEstadio() {
        $estadio = new Estadio($_POST['pais'], $_POST['nome']); // ← Usa nome diferente

        // Verifica se já existe um estádio com o mesmo nome
        foreach ($this->estadios as $e) {
            if($e->getNome() == $_POST['nome']) {
                throw new Exception("Já existe um estádio com o nome '{$_POST['nome']}'!");
            }
        }

        $this->estadios[] = $estadio; // ← Adiciona o estádio correto
        $this->message = "Estádio adicionado com sucesso!";
    }

    private function addClube() {
        $estadio = $this->buscarEStadioporId($_POST['estadio_id']);
        if ($estadio) {
            $this->clubeController->criarClube($_POST['nome'], $_POST['pais'], $estadio);
            $this->message = "Clube adicionado com sucesso!";
        } else {
            $this->message = "Estádio não encontrado!";
        }
    }

    private function addJogador() {
        $nascimento = new \DateTime($_POST['nascimento']);
        $this->jogadorController->criarJogador(
            $_POST['nome'], $_POST['nacionalidade'], $nascimento,
            $_POST['posicao'], $_POST['pe_dominante'],
            (float)$_POST['altura'], (float)$_POST['peso']
        );
        $this->message = "Jogador adicionado com sucesso!";
    }

    private function addCompeticao() {
        $this->competicaoController->criarCompeticao(
            $_POST['nome'], (int)$_POST['num_clubes'],
            $_POST['pais'], $_POST['tipo']
        );
        $this->message = "Competição adicionada com sucesso!";
    }

    private function addClubeCompeticao() {
        $competicao = $this->competicaoController->buscarCompeticaoPorId($_POST['competicao_id']);
        $clube = $this->clubeController->buscarClubePorId((int)$_POST['clube_id']);

        if ($competicao && $clube) {
            $this->competicaoController->adicionarClubeCompeticao($competicao, $clube);
            $this->message = "Clube adicionado à competição!";
        } else {
            $this->message = "Competição ou clube não encontrado!";
        }
    }

    private function finalizarPartida() {
        $competicao = $this->competicaoController->buscarCompeticaoPorId($_POST['competicao_id']);
        $clubeCasa = $this->clubeController->buscarClubePorId((int)$_POST['clube_casa_id']);
        $clubeVisitante = $this->clubeController->buscarClubePorId((int)$_POST['clube_visitante_id']);

        if ($competicao && $clubeCasa && $clubeVisitante) {
            $partida = new Partida($competicao, $clubeCasa, $clubeVisitante, new \DateTime());
            $partida->finalizar((int)$_POST['gols_casa'], (int)$_POST['gols_visitante']);
            $this->message = "Resultado registrado com sucesso!";
        } else {
            $this->message = "Dados inválidos para a partida!";
        }
    }

    private function buscarEStadioporId($id) {           // com não tem EstadioController ( acreditei não ser necessário)
        foreach ($this->estadios as $estadio) {
            if ($estadio->getId() == $id) return $estadio;
        }
        return null;
    }

    public function render() {
        $tabelaOutput = $this->getTabelaOutput();
        include 'View/template.php';
    }

    private function getTabelaOutput() {
        // Só processa se realmente foi solicitado mostrar a tabela
        if (!isset($_GET['ver_tabela']) || !isset($_GET['competicao_id'])) {
            return '';
        }

        $competicao = $this->competicaoController->buscarCompeticaoPorId($_GET['competicao_id']);

        if (!$competicao) {
            return '<div class="alert alert-warning">Competição não encontrada!</div>';
        }

        return $this->competicaoController->mostrarTabela($competicao);
    }

    // Getters para o template
    public function getMessage() { return $this->message; }
    public function getEstadios() { return $this->estadios; }
    public function getClubes() { return $this->clubeController->getClubes(); }
    public function getCompeticoes() { return $this->competicaoController->listarCompeticoes(); }
}
