<?php

namespace Controller;

use Exception;
use Model\Jogador;
use Model\Clube;
use ArrayObject;

class JogadorController{

    private ArrayObject $jogadores;

    public function __construct(){
        $this->jogadores = new ArrayObject();
    }

    public function criarJogador(string $nome, string $nacionalidade, \DateTime $nascimento, string $posicao, string $peDominante,float $altura, float $peso ) : Jogador{
        if ($this->buscarJogador($nome) != null){
            throw  new Exception("O jogador {$nome} já está cadastrado");
        }
         $jogador = new Jogador($nome, $nascimento, $nacionalidade, $posicao, $peDominante, $altura, $peso);
         $this->jogadores->append($jogador);
         return $jogador;
    }

    public  function listarJogadores() : ArrayObject{
        return $this->jogadores;
    }

    public function transferirJogador( Jogador $jogador, Clube $clubeDestino) :void{
        $jogador->transferirPara($clubeDestino);
    }

    public function atualizarEstatisticasJogador(Jogador $jogador, $gols = 0,
                                                 $assistencias = 0,$cartoesAmarelos = 0,
                                                 $cartaoVermelho = 0): void{

        # em uma partida, um jogador só pode receber 1 ou 2 cartões amarelos
        if ($cartoesAmarelos > 2 || $cartoesAmarelos < 0){
            throw new Exception("O número de cartões amarelos deve ser entre 0 e 2!");
        }
        # em uma partida, um jogador só pode receber 1 cartão vermelho
        if ($cartaoVermelho > 1 || $cartaoVermelho < 0){
            throw new Exception("O número de cartões vermelhos deve ser 0 ou 1!");
        }
        # incrementa o número de partidas jogadas
        $jogador->jogarPartida();

        if ($gols > 0){
            while($gols--){
                    $jogador->marcarGol();
            }
        }
        if ($assistencias > 0){
            while($assistencias--){
                $jogador->darAssistencia();
            }
        }
        if ($cartoesAmarelos > 0){
            while($cartoesAmarelos--){
                $jogador->tomarCartaoAmarelo();
            }
        }
        if($cartaoVermelho){
            $jogador->tomarCartaoVermelho();
        }
    }

    public function buscarJogador(string $nome) : ?Jogador{ // buscar um jogador pelo seu nome
        foreach ($this->jogadores as $j){
            if (strcasecmp($j->getNome(), $nome) === 0){ // strcasecmp compara as astring independente da caixa alta ou baixa
                return $j;
            }
        }
        return null;
    }

    public function visualizarEstatisticasJogador(Jogador $jogador) : void{
        echo "Nome: {$jogador->getNome()}\n";
        echo "Nacionalidade: {$jogador->getNacionalidade()}\n";
        echo "Data de Nascimento: {$jogador->getNascimento()->format('d/m/Y')}\n";
        echo "Gols: {$jogador->getGols()}\n";
        echo "Partidas: {$jogador->getPartidas()}\n";
        echo "Assistências: {$jogador->getAssistencias()}\n";
        echo "Cartões Amarelos: {$jogador->getCartoesAmarelos()}\n";
        echo "Cartões Vermelhos: {$jogador->getCartoesVermelhos()}\n";
        echo "Média de Gols: {$jogador->calcularMediaGols()}\n";
    }


}