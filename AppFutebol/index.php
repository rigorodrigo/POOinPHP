<?php
session_start();

// Inclui autoloader ou arquivos necessários
require_once 'Model/TraitId.php';
require_once 'Model/Pessoa.php';
require_once 'Model/Estadio.php';
require_once 'Model/Clube.php';
require_once 'Model/Jogador.php';
require_once 'Model/Competicao.php';
require_once 'Model/Partida.php';
require_once 'Model/Treinador.php';
require_once 'Controller/ClubeController.php';
require_once 'Controller/JogadorController.php';
require_once 'Controller/CompeticaoController.php';
require_once 'View/MainView.php';

use Controller\ClubeController;
use Controller\JogadorController;
use Controller\CompeticaoController;
use View\MainView;
use Model\Estadio;
use Model\Treinador;
use Model\Partida;


// Inicializa dados mock
if (!isset($_SESSION['initialized'])) {
    gerarMock();
    $_SESSION['initialized'] = true;
}

// Inicializa a view principal
$mainView = new MainView();
$mainView->render();

function gerarMock() {

    $competicaoController = new CompeticaoController();
    $clubeController = new ClubeController();
    $jogadorController = new JogadorController();

    // Criando estádios
    try {
        $maracana = new Estadio("Brasil", "Maracanã");
        $morumbi = new Estadio("Brasil", "Morumbi");
        $allianzParque = new Estadio("Brasil", "Allianz Parque");
        $beiraRio = new Estadio("Brasil","Beira Rio");
    }catch (Exception $e) {
        echo $e->getMessage();
    }


    // Criar clubes
    try {

        $flamengo = $clubeController->criarClube("Flamengo","Brasil", $maracana);
        $palmeiras = $clubeController->criarClube("Palmeiras","Brasil", $allianzParque);
        $saopaulo = $clubeController->criarClube("São Paulo","Brasil", $morumbi);
        $internacional = $clubeController->criarClube("Internacional","Brasil", $beiraRio);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    // Criar treinadores
    $rogerMachado = new Treinador("Roger Machado", new DateTime("1975-04-25"), "Brasileiro", "4-2-3-1", $internacional);
    $abelFerreira = new Treinador("Abel Ferreira", new DateTime("1978-12-22"), "Português", "4-2-3-1", $palmeiras);
    $filipeLuis = new Treinador("Filipe Luis", new DateTime("1985-08-09"), "Brasileiro", "4-2-3-1", $flamengo);

    // Criar jogadores
    try {

        $nicoDelaCruz = $jogadorController->criarJogador("Nicolás De la Cruz", "Uruguaio", new DateTime("1997-06-01"), "Meia", "Direito", 1.67, 65);
        $deArrascaeta = $jogadorController->criarJogador("Giorgian De Arrascaeta", "Uruguaio", new DateTime("1994-06-01"), "Meia", "Direito", 1.74, 70);
        $brunoHenrique27 = $jogadorController->criarJogador("Bruno Henrique", "Brasileiro", new DateTime("1990-12-30"), "Atacante", "Direito", 1.84, 80);

        $raphaelVeiga = $jogadorController->criarJogador("Raphael Veiga", "Brasileiro", new DateTime("1995-06-19"), "Meia", "Esquerdo", 1.78, 73);
        $vitorRoque = $jogadorController->criarJogador("Vitor Roque", "Brasileiro", new DateTime("2005-02-28"), "Atacante", "Direito", 1.74, 68);
        $paulinho = $jogadorController->criarJogador("Paulinho", "Brasileiro", new DateTime("2000-07-15"), "Atacante", "Direito", 1.77, 70);

        $luciano = $jogadorController->criarJogador("Luciano", "Brasileiro", new DateTime("1993-05-18"), "Atacante", "Direito", 1.75, 72);
        $lucasMoura = $jogadorController->criarJogador("Lucas Moura", "Brasileiro", new DateTime("1992-08-13"), "Atacante", "Direito", 1.72, 70);
        $jonathanCalleri = $jogadorController->criarJogador("Jonathan Calleri", "Argentino", new DateTime("1993-09-23"), "Atacante", "Direito", 1.80, 70);

        $alanPatrick = $jogadorController->criarJogador("Alan Patrick", "Brasileiro", new DateTime("1991-05-13"), "Meia", "Direito", 1.77, 71);
        $fernandoReges = $jogadorController->criarJogador("Fernando Reges", "Brasileiro", new DateTime("1987-07-25"), "Volante", "Direito", 1.83, 77);
        $braianAguirre = $jogadorController->criarJogador("Braian Nahuel Aguirre", "Argentino", new DateTime("2000-07-28"), "Lateral", "Direito", 1.75, 70);
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    // Adicionando os jogadores aos seus respectivos clubes

    $flamengo->adicionarJogador($nicoDelaCruz);
    $flamengo->adicionarJogador($deArrascaeta);
    $flamengo->adicionarJogador($brunoHenrique27);

    $palmeiras->adicionarJogador($raphaelVeiga);
    $palmeiras->adicionarJogador($vitorRoque);
    $palmeiras->adicionarJogador($paulinho);

    $saopaulo->adicionarJogador($jonathanCalleri);
    $saopaulo->adicionarJogador($luciano);
    $saopaulo->adicionarJogador($lucasMoura);

    $internacional->adicionarJogador($alanPatrick);
    $internacional->adicionarJogador($fernandoReges);
    $internacional->adicionarJogador($braianAguirre);

    // Adicionando treinadores aos seus respectivos clubes

    $flamengo->setTreinador($filipeLuis);
    $palmeiras->setTreinador($abelFerreira);
    $internacional->setTreinador($rogerMachado);

    // Criar competição
    try{
        $brasileirao = $competicaoController->criarCompeticao("Brasileirão Série A", 20, "Brasil", "Nacional");
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    // Adicionar clubes à competição
    $competicaoController->adicionarClubeCompeticao($brasileirao, $flamengo);
    $competicaoController->adicionarClubeCompeticao($brasileirao, $palmeiras);
    $competicaoController->adicionarClubeCompeticao($brasileirao, $saopaulo);
    $competicaoController->adicionarClubeCompeticao($brasileirao, $internacional);

    // Criar partidas
    $data1 = new DateTime("2025-05-25");
    $data2 = new DateTime("2025-08-22");
    $data3 = new DateTime("2025-05-11");

    $partida1 = new Partida($brasileirao,$palmeiras,$flamengo, $data1);
    $partida2 = new Partida($brasileirao, $internacional, $saopaulo, $data2);
    $partida3 = new Partida($brasileirao, $saopaulo,$palmeiras,$data3);
    $partida4 = new Partida($brasileirao,$flamengo,$internacional,$data3);

    // Finalizando as partidas
    $partida1->finalizar(0,2);
    $partida2->finalizar(5,2);
    $partida3->finalizar(0,1);
    $partida4->finalizar(1,1);

    // Array com todos os estádios
    $estadios = [
        $maracana,
        $morumbi,
        $allianzParque,
        $beiraRio
    ];

    // Salva na sessão
    $_SESSION['clubeController'] = serialize($clubeController);
    $_SESSION['jogadorController'] = serialize($jogadorController);
    $_SESSION['competicaoController'] = serialize($competicaoController);
    $_SESSION['estadios'] = serialize($estadios);
}
