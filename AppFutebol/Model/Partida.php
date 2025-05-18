<?php

namespace Model;

use Model\Competicao;
use Model\Clube;

class Partida
{
    use TraitId;
    private $id;
    private $data;
    private $competicao;
    private $clubeCasa;
    private $clubeVisitante;
    private $golsCasa = 0;
    private $golsVisitante = 0;

    public function __construct( Competicao $competicao,  Clube $clubeCasa, Clube $clubeVisitante, \DateTime  $data )
    {
        $this->competicao = $competicao;
        $this->clubeCasa = $clubeCasa;
        $this->clubeVisitante = $clubeVisitante;
        $this->data = $data;

    }

    public function getData()
    {
        return $this->data;
    }

    public function getCompeticao()
    {
        return $this->competicao;
    }

    public function getClubeCasa()
    {
        return $this->clubeCasa;
    }

    public function getClubeVisitante()
    {
        return $this->clubeVisitante;
    }

    public function getGolsCasa()
    {
        return $this->golsCasa;
    }

    public function getGolsVisitante()
    {
        return $this->golsVisitante;
    }

}