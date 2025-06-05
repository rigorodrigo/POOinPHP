<?php

namespace Model;

// trait para facilitar a reutilização de código na hora de gerar um id para algum objeto

trait TraitId
{
    private static int  $contador = 0;
    private int  $id;

    protected function setId(string $nome = ''){
        // Gera um ID baseado no nome do objeto usando uma função hash
        // Usamos crc32 que retorna um número inteiro de 32 bits
        // Obtemos o nome da classe e concatenamos com o nome fornecido
        $className = get_class($this);
        $this->id = crc32($className . $nome);
    }

    public function getId(){
        return $this->id;
    }
}