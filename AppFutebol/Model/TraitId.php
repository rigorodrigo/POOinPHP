<?php

namespace Model;

// trait para facilitar a reutilização de código na hora de gerar um id para algum objeto

trait TraitId
{
    private static $contador = 0;
    private $id;

    protected function setId(){
        $this->id = self::$contador++;
    }

    public function getId(){
        return $this->id;
    }
}