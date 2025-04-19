<?php

namespace App\Models;

use Config\Database;
use PDO;

class Classes 
{
    private PDO $db;

    public function __construct() 
    {
        $this->db = Database::getConnection();
    }

    public function all(): array 
    {
        $classes = $this->db
            ->query("SELECT t.id, t.nome, t.descricao, COUNT(m.id) as total_alunos FROM turmas AS t
                LEFT JOIN matriculas AS m ON t.id = m.turma_id
                GROUP BY t.id, t.nome, t.descricao
                ORDER BY t.nome ASC");

        return $classes->fetchAll(); 
    }

    public function find(int $id): array 
    {
        $class = $this->db->prepare("SELECT * FROM turmas WHERE id = :id");
        $class->execute([
            'id' => $id
        ]);
        return $class->fetch();
    }

    public function findClassByStudents(int $id): array 
    {
        $sqlClass = $this->db->prepare("SELECT * FROM turmas WHERE id = :id");
        $sqlClass->execute(['id' => $id]);
        $class = $sqlClass->fetch(PDO::FETCH_ASSOC);

        if (!$class) {
            return [];
        }
        $sqlStudents = $this->db->prepare("
            SELECT a.id, a.nome, a.email
            FROM matriculas m
            INNER JOIN alunos a ON a.id = m.aluno_id
            WHERE m.turma_id = :id
            ORDER BY a.nome ASC
        ");
        $sqlStudents->execute(['id' => $id]);
        $students = $sqlStudents->fetchAll(PDO::FETCH_ASSOC);

        return [
            'id' => $class['id'],
            'nome' => $class['nome'],
            'descricao' => $class['descricao'],
            'alunos' => $students
        ];
    }

    public function create(array $data): bool
    {
        $sql = $this->db->prepare( "INSERT INTO turmas (nome, descricao) VALUES (:nome, :descricao)");
        return $sql->execute([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE turmas SET nome = :nome, descricao = :descricao WHERE id = :id";
        $params = [
            'id' => $id,
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
        ];
        $request = $this->db->prepare($sql);
        return $request->execute($params);
    }

    public function delete(int $id): bool
    {
        $sql = $this->db->prepare("DELETE FROM turmas WHERE id = :id");
        return $sql->execute([
            'id' => $id
        ]);   
    }
}