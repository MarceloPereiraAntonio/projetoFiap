<?php

namespace App\Models;

use Config\Database;
use PDO;

class Student 
{
    private PDO $db;

    public function __construct() 
    {
        $this->db = Database::getConnection();
    }

    public function all(): array 
    {
        $students = $this->db->query("SELECT * FROM alunos ORDER BY nome ASC");
        return $students->fetchAll(); 
    }

    public function find(int $id): array 
    {
        $student = $this->db->prepare("SELECT id, nome, cpf, data_nascimento, email FROM alunos WHERE id = :id");
        $student->execute([
            'id' => $id
        ]);
        return $student->fetch();
    }

    public function create(array $data): bool
    {
        $sql = $this->db->prepare( "INSERT INTO alunos (nome, cpf, data_nascimento, email, senha) 
            VALUES (:nome, :cpf, :data_nascimento, :email, :senha)"
        );

        return $sql->execute([
            'nome' => $data['nome'],
            'cpf' => $data['cpf'],
            'data_nascimento' => $data['data_nascimento'],
            'email' => $data['email'],
            'senha' => password_hash($data['senha'], PASSWORD_BCRYPT)
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE alunos SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento, email = :email";
        $params = [
            'id' => $id,
            'nome' => $data['nome'],
            'cpf' => $data['cpf'],
            'data_nascimento' => $data['data_nascimento'],
            'email' => $data['email'],
        ];

        if (!empty($data['senha'])) {
            $sql .= ", senha = :senha";
            $params['senha'] = password_hash($data['senha'], PASSWORD_BCRYPT);
        }

        $sql .= " WHERE id = :id";

        $request = $this->db->prepare($sql);
        return $request->execute($params);
    }

    public function delete(int $id): bool
    {
        $sql = $this->db->prepare("DELETE FROM alunos WHERE id = :id");
        return $sql->execute([
            'id' => $id
        ]);   
    }
}