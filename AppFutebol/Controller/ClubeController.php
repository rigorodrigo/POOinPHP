<?php

namespace Controller;

use ArrayObject;
use Exception;
use Model\Clube;
use Model\Estadio;

class ClubeController
{
    private ArrayObject $clubes;

    public function __construct()
    {
        $this->clubes = new ArrayObject();
    }
    public function criarClube($nome, $pais, Estadio $estadio) : Clube {
        // Verifica se já existe um clube com o mesmo nome
        if ($this->buscarClubePorNome($nome) !== null) {
            throw new Exception("Já existe um clube com o nome '$nome'!");
        }
        // Cria o novo clube apenas se não existir duplicata
        $clube = new Clube($nome, $pais, $estadio);
        $this->clubes[] = $clube;
        return $clube;
    }


    public function getClubes(): ArrayObject {
        return $this->clubes;
    }

    public function buscarClubePorNome(string $nome): ?Clube {
        foreach ($this->clubes as $clube) {
            if (strcasecmp($clube->getNome(), $nome) === 0) {
                return $clube;
            }
        }
        return null;
    }

    public function buscarClubePorId(int $id): ?Clube {
        foreach ($this->clubes as $clube) {
            if ($clube->getId() === $id) {
                return $clube;
            }
        }
        return null;
    }
}