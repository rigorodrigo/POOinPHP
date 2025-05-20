<?php

namespace Controller;

use Model\Partida;
use Model\Competicao;
use Model\Clube;
use Model\Jogador;
use DateTime;

class PartidaController
{
    public function criarPartida( Competicao $competicao, Clube $clubeCasa, Clube $clubeVisitante, \DateTime $data ){
        if($clubeCasa->getId() == $clubeVisitante->getId()){
            throw new \LogicException("Um clube não pode jogar contra si mesmo!");
        }

        if (!$competicao->temClube($clubeCasa) || $competicao->temClube($clubeVisitante)) {
            throw new \LogicException("Clubes devem pertencer a competição!");
        }

        return new Partida($competicao, $clubeCasa, $clubeVisitante, $data);
    }

}