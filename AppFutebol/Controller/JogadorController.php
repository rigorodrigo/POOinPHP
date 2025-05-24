<?php

namespace Controller;

use Model\Jogador;
use Model\Clube;

class JogadorController{
    public function transferirJogador( Jogador $jogador, Clube $clubeDestino){
        if ($jogador->getClube()->getId() == $clubeDestino->getId()) {
            throw new \LogicException("O jogador já pertence ao clube {$clubeDestino->getNome()}!");
        }
        if($jogador->getClube() == null){
            $jogador->setClube(($clubeDestino));
        }

        else{
            $jogador->getClube()->removerJogador($jogador);
            $clubeDestino->adicionarJogador($jogador);
        }
    }

    public function atualizarEstatisticasJogador(Jogador $jogador, $gols = 0,
                                                 $assistencias = 0,$cartoesAmarelos = 0,
                                                 $cartaoVermelho = 0){

        # em uma partida, um jogador só pode receber 1 ou 2 cartões amarelos
        if ($cartoesAmarelos > 2 || $cartoesAmarelos < 0){
            throw new \LogicException("O número de cartões amarelos deve ser entre 0 e 2!");
        }
        # em uma partida, um jogador só pode receber 1 cartão vermelho
        if ($cartaoVermelho > 1 || $cartaoVermelho < 0){
            throw new \LogicException("O número de cartões vermelhos deve ser 0 ou 1!");
        }
        # incrementa o número de partidas jogadas
        $jogador->setPartidas($jogador->getPartidas() + 1);

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
            while($cartAmarelos--){
                $jogador->tomarCartaoAmarelo();
            }
        }
        if($cartaoVermelho){
            $jogador->tomarCartaoVermelho();
        }
    }

    public function calcularMediaGols(Jogador $jogador){
        return $jogador->getGols() / $jogador->getPartidas();
    }

    public function visualizarEstatisticasJogador(Jogador $jogador){
        echo "Nome: {$jogador->getNome()}\n";
        echo "Nacionalidade: {$jogador->getNacionalidade()}\n";
        echo "Data de Nascimento: {$jogador->getNascimento()->format('d/m/Y')}\n";
        echo "Gols: {$jogador->getGols()}\n";
        echo "Partidas: {$jogador->getPartidas()}\n";
        echo "Assistências: {$jogador->getAssistencias()}\n";
        echo "Cartões Amarelos: {$jogador->getCartaoAmarelos()}\n";
        echo "Cartões Vermelhos: {$jogador->getCartaoVermelho()}\n";
        echo "Média de Gols: {$this->calcularMediaGols($jogador)}\n";
    }

}