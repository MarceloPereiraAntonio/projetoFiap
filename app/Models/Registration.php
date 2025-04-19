<?php

namespace App\Models;

use Config\Database;
use PDO;

class Registration
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(int $alunoId, int $turmaId): bool
    {
        $sql = $this->db->prepare("
            INSERT INTO matriculas (aluno_id, turma_id)
            VALUES (:aluno_id, :turma_id)
        ");

        return $sql->execute([
            'aluno_id' => $alunoId,
            'turma_id' => $turmaId
        ]);
    }

    public function exists(int $alunoId, int $turmaId): bool
    {
        $sql = $this->db->prepare("
            SELECT id FROM matriculas
            WHERE aluno_id = :aluno_id AND turma_id = :turma_id
        ");
        $sql->execute([
            'aluno_id' => $alunoId,
            'turma_id' => $turmaId
        ]);

        return $sql->fetch(PDO::FETCH_ASSOC) !== false;
    }
}
