<?php

namespace App\Requests;

class StoreClassesRequest
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty($data['nome']) || strlen($data['nome']) < 3) {
            $errors['nome'] = 'O nome deve ter no mínimo 3 caracteres.';
        }

        if (empty($data['descricao']) || strlen($data['descricao']) < 3) {
            $errors['descricao'] = 'Informe uma descrição.';
        }
             
        return $errors;
        
    }
}