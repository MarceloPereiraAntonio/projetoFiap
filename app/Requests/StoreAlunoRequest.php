<?php

namespace App\Requests;

use Config\Database;

class StoreAlunoRequest
{
    public static function validate(array $data, ?int $id = null): array
    {
        $errors = [];

        if (empty($data['nome']) || strlen($data['nome']) < 3) {
            $errors['nome'] = 'O nome deve ter no mínimo 3 caracteres.';
        }
        
        if (empty($data['cpf']) ) {
            $errors['cpf'] = 'CPF é obrigatório.';
        } elseif (!preg_match('/^\d{11}$/', $data['cpf'])) {
            $errors['cpf'] = 'O CPF deve conter exatamente 11 números (somente dígitos).';
        } elseif (Self::valueExists('cpf', $data['cpf'], $id)) {
            $errors['cpf'] = 'O CPF informado já existe.';
        }
        
        if (empty($data['data_nascimento'])) {
            $errors['data_nascimento'] = 'A data de nascimento é obrigatória.';
        }
        
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'E-mail inválido.';
        } elseif (Self::valueExists('email', $data['email'], $id)) {
            $errors['email'] = 'O e-mail informado já existe.';
        }
        
        if ($id === null && empty($data['senha'])) {
            $errors['senha'] = 'A senha é obrigatória.';
        } elseif (!empty($data['senha'])) {
            $senha = $data['senha'];
        
            if (strlen($senha) < 8) {
                $errors['senha'] = 'A senha deve ter no mínimo 8 caracteres.';
            } elseif (
                !preg_match('/[A-Z]/i', $senha) ||
                !preg_match('/[0-9]/', $senha) || 
                !preg_match('/[^A-Za-z0-9]/', $senha)
            ) {
                $errors['senha'] = 'A senha deve conter letras, números e pelo menos um símbolo. (Ex: !@#$)';
            }
        }        
        
        return $errors;
        
    }

    private static function valueExists(string $field, string $value, ?int $ignoreId = null): bool
    {
        $db = Database::getConnection();
    
        $allowedFields = ['cpf', 'email'];
        if (!in_array($field, $allowedFields)) {
            throw new \InvalidArgumentException('Campo inválido.');
        }
        $query = "SELECT id FROM alunos WHERE $field = :value";
        $params = ['value' => $value];

        if ($ignoreId !== null) {
            $query .= " AND id != :id";
            $params['id'] = $ignoreId;
        }
    
        $stmt = $db->prepare($query);
        $stmt->execute($params);
    
        return $stmt->fetch() ? true : false;
    }
    
}
