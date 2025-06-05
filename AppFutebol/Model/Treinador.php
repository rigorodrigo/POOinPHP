<?php

namespace Model;

use Model\Pessoa;

class Treinador extends Pessoa
{
     private  Clube $clube;
     private string $formacaoFavorita;

    public function __construct($nome,$nascimento, $nacionalidade, $formacaoFavorita,  Clube $clube)
    {
        parent::__construct($nome, $nascimento, $nacionalidade);
        $this->formacaoFavorita = $formacaoFavorita;
        $this->clube = $clube;
    }

    /**
     * @return mixed
     */
    public function getClube()
    {
        return $this->clube;
    }

    /**
     * @param mixed $clube
     */
    public function setClube( Clube $clube): void
    {
        $this->clube = $clube;
    }

    public function getFormacaoFavorita()
    {
        return $this->formacaoFavorita;
    }

    public function setFormacaoFavorita($formacaoFavorita) :void
    {
        $this->formacaoFavorita = $formacaoFavorita;
    }



}