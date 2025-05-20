<?php


use View\MainView;
use Controller\CompeticaoController;
use Controller\PartidaController;
use Model\Clube;
use Model\Estadio;
use Model\Jogador;
use Model\Treinador;

// Criar alguns dados de exemplo para teste
function gerarMock() {
    $competicaoController = new CompeticaoController();
    $partidaController = new PartidaController();
    
    // Criando estádios

    $maracana = new Estadio("Brasil", "Maracanã");
    $morumbi = new Estadio("Brasil", "Morumbi");
    $allianzParque = new Estadio("Brasil", "Allianz Parque");
    $beiraRio = new Estadio("Brasil","Beira Rio");
    
    // Criando treinadores

    $filipeLuis = new Treinador("Filipe Luis", "Brasileiro", new DateTime("1985-08-09"),  28, 3, 9);
    $abelFerreira = new Treinador("Abel Ferreira", "Português", new DateTime("1978-12-22"),180, 60, 60);
    $luisZubeldia = new Treinador("Luis Francisco Zubeldía", "Argentino", new DateTime("1981-01-13"), 20, 20, 20);
    $rogerMachado = new Treinador("Roger Machado", "Brasileiro", new DateTime("1975-04-25"), 28, 3, 9);
    
    // Criar clubes
    $flamengo = new Clube("Flamengo", "Brasil", $maracana, $filipeLuis);
    $palmeiras = new Clube("Palmeiras", "Brasil", $allianzParque, $abelFerreira);
    $saopaulo = new Clube("São Paulo", "Brasil", $morumbi, $luisZubeldia);
    $internacional = new Clube("Internacional", "Brasil", $beiraRio, $rogerMachado);
    
    // Criar jogadores

    $nicoDelaCruz = new Jogador("Nicolás De la Cruz", new DateTime("1997-06-01"), "Uruguaio", "Meia", "Direito", 1.67, 65, 100, 8, 11, 6, 0, $flamengo);
    $deArrascaeta = new Jogador("Giorgian De Arrascaeta", new DateTime("1994-06-01"), "Uruguaio", "Meia", "Direito", 1.74, 70, 180, 50, 80, 15, 2, $flamengo);
    $brunoHenrique27 = new Jogador("Bruno Henrique", new DateTime("1990-12-30"), "Brasileiro", "Atacante", "Direito", 1.84, 80, 150, 100, 40, 25, 3, $flamengo);

    $raphaelVeiga = new Jogador("Raphael Veiga", new DateTime("1995-06-19"), "Brasileiro", "Meia", "Esquerdo", 1.78, 73, 180, 70, 40, 10, 1, $palmeiras);
    $vitorRoque = new Jogador("Vitor Roque", new DateTime("2005-02-28"), "Brasileiro", "Atacante", "Direito", 1.74, 68, 25, 5, 1, 1, 0, $palmeiras);
    $paulinho = new Jogador("Paulinho", new DateTime("2000-07-15"), "Brasileiro", "Atacante", "Direito", 1.77, 70, 8, 1, 2, 1, 0, $palmeiras);

    $luciano = new Jogador("Luciano", new DateTime("1993-05-18"), "Brasileiro", "Atacante", "Direito", 1.75, 72, 150, 80, 20, 15, 2, $saopaulo);
    $lucasMoura = new Jogador("Lucas Moura", new DateTime("1992-08-13"), "Brasileiro", "Atacante", "Direito", 1.72, 70, 300, 100, 50, 10, 1, $saopaulo);
    $jonathanCalleri = new Jogador("Jonathan Calleri", new DateTime("1993-09-23"), "Argentino", "Atacante", "Direito", 1.80, 78, 120, 60, 15, 25, 3, $saopaulo);

    $alanPatrick = new Jogador ("Alan Patrick", new DateTime("1991-05-13"), "Brasileiro", "Meia", "Direito", 1.77,71, 200, 35, 60, 25, 0, $internacional);
    $fernandoReges = new Jogador ("Fernando Reges", new DateTime("1987-07-25"),"Brasileiro", "Volante", "Direito", 1.83, 77, 50, 3, 3, 10, 0, $internacional);
    $braianAguirre = new Jogador ("Braian Nahuel Aguirre", new DateTime("2000-07-28"),"Argentino", "Lateral", "Direito", 1.75, 70, 33,  1, 6, 5, 0 , $internacional);

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

    // Criar competição
    $brasileirao = $competicaoController->criarCompeticao("Brasileirão Série A", 20, "Brasil", "Pontos Corridos");
    
    // Adicionar clubes à competição
    $competicaoController->adicionarClubeCompeticao($brasileirao, $flamengo);
    $competicaoController->adicionarClubeCompeticao($brasileirao, $palmeiras);
    $competicaoController->adicionarClubeCompeticao($brasileirao, $saopaulo);
    $competicaoController->adicionarClubeCompeticao($brasileirao, $internacional);
    
    // Criar partidas
    $data1 = new DateTime("2025-05-25");
    $data2 = new DateTime("2025-08-22");
    $data3 = new DateTime("2025-05-11");
    
    $partida1 = $partidaController->criarPartida($brasileirao, $flamengo, $palmeiras, $data1);
    $partida2 = $partidaController->criarPartida($brasileirao, $saopaulo, $flamengo, $data2);
    $partida3 = $partidaController->criarPartida($brasileirao, $palmeiras, $saopaulo, $data3);
    $partida4 = $partidaController->criarPartida($brasileirao, $internacional, $flamengo, $data3);
    
    return [
        'competicoes' => [$brasileirao],
        'clubes' => [$flamengo, $palmeiras, $saopaulo,$internacional],
        'partidas' => [$partida1, $partida2, $partida3,$partida4]
    ];
}

gerarMock();

// Iniciar a aplicação

$mainView = new MainView();
$mainView->exibirMenu();