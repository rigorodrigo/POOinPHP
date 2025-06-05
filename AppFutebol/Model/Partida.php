<?php

namespace Model;

use DateTime;
use InvalidArgumentException;
use RuntimeException;

class Partida
{
    use TraitId;
    private  int $id;
    private DateTime $data;
    private Competicao $competicao;
    private Clube $clubeCasa;
    private Clube $clubeVisitante;
    private Estadio $estadio;
    private int $golsCasa = 0;
    private int $golsVisitante = 0;
    private bool $finalizada = false;

    # construtor instancia a partida, mas não dá a ela o resultado.
    # Não há setters para estes atributos do contrutor para não poder modificar a partida em si, apenas o resultado.

    public function __construct( Competicao $competicao,  Clube $clubeCasa, Clube $clubeVisitante, DateTime  $data)
    {
        $this->setId($competicao->getNome() . $clubeCasa->getNome() . $clubeVisitante->getNome() . $data->format('Y-m-d'));
        $this->competicao = $competicao;
        $this->clubeCasa = $clubeCasa;
        $this->clubeVisitante = $clubeVisitante;
        $this->data = $data;
        $this->estadio = $clubeCasa->getEstadio();
    }

    public function getData() : DateTime
    {
        return $this->data;
    }

    public function getCompeticao() : Competicao
    {
        return $this->competicao;
    }

    public function getClubeCasa() : Clube
    {
        return $this->clubeCasa;
    }

    public function getClubeVisitante() : Clube
    {
        return $this->clubeVisitante;
    }

    public function getEstadio() : Estadio
    {
        return $this->clubeCasa->getEstadio();
    }

    public function getGolsCasa() : int
    {
        return $this->golsCasa;
    }

    public function getGolsVisitante() : int
    {
        return $this->golsVisitante;
    }

    public function setGolsCasa($golsCasa) : void
    {
        if ($golsCasa < 0) {
            throw new InvalidArgumentException("Gols não podem ser negativos!");
        }
        $this->golsCasa = $golsCasa;
    }

    public function setGolsVisitante($golsVisitante) : void
    {
        if ($golsVisitante < 0) {
            throw new InvalidArgumentException("Gols não podem ser negativos!");
        }
        $this->golsVisitante = $golsVisitante;
    }

    public function finalizar($golsCasa, $golsVisitante) : void {
        if ($this->finalizada) {
            throw new RuntimeException("Partida já foi finalizada!");
        }
        $this->setGolsCasa($golsCasa);
        $this->setGolsVisitante($golsVisitante);
        $this->competicao->registrarResultado($this);
        $this->finalizada = true; // Marca como finalizada
    }
}
